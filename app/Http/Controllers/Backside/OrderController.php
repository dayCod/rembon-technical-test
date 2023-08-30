<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateAndUpdateOrderRequest;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $process = app('PaidOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        return redirect()->route('backside.order.index-view')->with('success', $process['message']);
    }

    /**
     * delete specific order data.
     *
     * @return JsonResponse
     */
    public function deleteSpecificOrder(string $uuid): JsonResponse
    {
        $process = app('DeleteOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        return response()->json(['success', $process['message']]);
    }
}
