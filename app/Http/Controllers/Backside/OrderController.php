<?php

namespace App\Http\Controllers\Backside;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\ProdukPesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Order\CreateAndUpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * display order index view page.
     *
     * @return View
     */
    public function orderIndexView(): View
    {
        $orders = Pesanan::with('produkPesanan', 'user')->orderBy('id', 'desc')->get();
        // dd($orders[1]->getTotalPriceOfProductOrder());

        return view('page.pesanan.index', compact('orders'));
    }

    /**
     * display create order form.
     *
     * @return View
     */
    public function createOrderFormView(): View
    {
        $products = Produk::with('stokProduk')->orderBy('id', 'desc')->get()->filter(function ($value) {
            return $value->stokProduk->stok > 0;
        })->values();

        return view('page.pesanan.create', compact('products'));
    }

    /**
     * store order data to pesanan and pesanan produk table.
     *
     * @param CreateAndUpdateOrderRequest $request
     * @return RedirectResponse
     */
    public function storeOrderToPesananAndProdukPesananTable(CreateAndUpdateOrderRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['buyer_id'] = auth()->id();

            $process = app('CreateOrder')->execute($data);
            DB::commit();

            return redirect()->route('backside.order.index-view')->with('success', $process['message']);

        } catch (\Exception $ex) {

            DB::rollBack();
            dd($ex->getMessage());

        }
    }

    /**
     * show specified order view.
     *
     * @param string $uuid
     * @return View
     */
    public function editOrderFormView(string $uuid): View
    {
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            abort(401);
        }

        $products = Produk::with('stokProduk')->orderBy('id', 'desc')->get()->filter(function ($value) {
            return $value->stokProduk->stok > 0;
        })->values();

        $find_order = Pesanan::with('produkPesanan')->where('uuid', $uuid)->first();

        return view('page.pesanan.edit', compact('find_order', 'products'));
    }

    /**
     * update specified order record.
     *
     * @param CreateAndUpdateOrderRequest $request
     * @param string $uuid
     * @return RedirectResponse
     */
    public function updateProductAction(CreateAndUpdateOrderRequest $request, string $uuid): RedirectResponse
    {
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            abort(401);
        }

        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['pesanan_uuid'] = $uuid;
            $data['buyer_id'] = auth()->id();

            $process = app('UpdateOrder')->execute($data);
            DB::commit();

            return redirect()->route('backside.order.index-view')->with('success', $process['message']);

        } catch (\Exception $ex) {

            DB::rollBack();
            dd($ex->getMessage());

        }
    }

    /**
     * update order status to cancel
     *
     * @param string $uuid
     * @return RedirectResponse
     */
    public function updateOrderStatusToCancel(string $uuid): RedirectResponse
    {
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            abort(401);
        }

        $process = app('CancelOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        return redirect()->route('backside.order.index-view')->with('success', $process['message']);
    }

    /**
     * update order status to paid
     *
     * @param string $uuid
     * @return RedirectResponse
     */
    public function updateOrderStatusToPaid(string $uuid): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Not Allowed if Status is'nt Pending
            if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
                abort(401);
            }

            $process = app('PaidOrder')->execute([
                'pesanan_uuid' => $uuid,
            ]);

            DB::commit();

            return redirect()->route('backside.order.index-view')->with('success', $process['message']);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    /**
     * delete specific order data.
     *
     * @return JsonResponse
     */
    public function deleteSpecificOrder(string $uuid): JsonResponse
    {
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() == "Pending") {
            abort(401);
        }

        $process = app('DeleteOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        return response()->json(['success', $process['message']]);
    }

    /**
     * display related product order data.
     *
     * @param string $uuid
     * @return View
     */
    public function showRelatedOrderedProduct(string $uuid): View
    {
        $find_order = Pesanan::where('uuid', $uuid)->first();
        $ordered_products = ProdukPesanan::where('pesanan_id', $find_order->id)->get();

        return view('page.pesanan.detail-pesanan', compact('ordered_products', 'uuid'));
    }

    /**
     * display order trashed data.
     *
     * @param string $uuid
     * @return View
     */
    public function trashedOrderView(string $uuid): View
    {
        $find_order = Pesanan::where('uuid', $uuid)->first();
        $trashed_ordered_products = ProdukPesanan::onlyTrashed()->where('pesanan_id', $find_order->id)->get();

        return view('page.pesanan.trashed-ordered-product', compact('trashed_ordered_products', 'uuid'));
    }

    /**
     * soft delete specified ordered product
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return JsonResponse
     */
    public function softDeleteOrderedProduct(string $order_uuid, string $order_product_uuid): JsonResponse
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();
        $process = app('DeleteOrderedProduct')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        return response()->json(['success' => $process['message']]);
    }

    /**
     * restore trashed product data.
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return RedirectResponse
     */
    public function restoreTrashedOrderedProduct(string $order_uuid, string $order_product_uuid): RedirectResponse
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();
        $process = app('RestoreOrderedProduct')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        return redirect()->route('backside.order.show-related-product', ['uuid' => $order_uuid])
            ->with('success', $process['message']);
    }

    /**
     * delete specified product permanently.
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return JsonResponse
     */
    public function deleteOrderedProductPermanently(string $order_uuid, string $order_product_uuid): JsonResponse
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();

        $process = app('DeleteOrderedProductPermanently')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        return response()->json([
            'success' => $process['message']
        ]);
    }
}
