<?php

namespace App\Http\Controllers\Api\Backside;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\ProdukPesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Response\JsonApiResponse;
use App\Http\Resources\OrderResourceCollection;
use App\Http\Requests\Order\CreateAndUpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * display all orders.
     *
     * @return JsonResponse
     */
    public function showAllOrders()
    {
        $orders = Pesanan::with('produkPesanan', 'user')->orderBy('id', 'desc')->get();

        if ($orders->count() < 1) return JsonApiResponse::notFound('Data Pesanan Tidak Ditemukan', []);

        return JsonApiResponse::success('Data Pesanan Berhasil Diambil', OrderResourceCollection::collectionData($orders));
    }

    /**
     * store order data to pesanan and pesanan produk table.
     *
     * @param CreateAndUpdateOrderRequest $request
     * @return JsonResponse
     */
    public function storeOrderToPesananAndProdukPesananTable(CreateAndUpdateOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['buyer_id'] = auth()->id();

            $process = app('CreateOrder')->execute($data);
            DB::commit();

            return JsonApiResponse::success($process['message'], $process['data']);

        } catch (\Exception $ex) {

            DB::rollBack();

            return JsonApiResponse::response($ex->getCode(), false, $ex->getMessage(), ['file' => $ex->getFile()]);
        }
    }

    /**
     * show specified order.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function findSpecificOrder(string $uuid)
    {
        $find_order = Pesanan::with('produkPesanan')->where('uuid', $uuid)->first();

        if (empty($find_order)) JsonApiResponse::notFound('Data Pesanan Yang Dimaksud Tidak Ditemukan', []);

        return JsonApiResponse::success('Data Pesanan Berhasil Ditemukan', $find_order->toArray());
    }

    /**
     * update specified order record.
     *
     * @param CreateAndUpdateOrderRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function updateProductAction(CreateAndUpdateOrderRequest $request, string $uuid)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['pesanan_uuid'] = $uuid;
            $data['buyer_id'] = auth()->id();

            $process = app('UpdateOrder')->execute($data);
            DB::commit();

            return JsonApiResponse::success($process['message'], $process['data']);

        } catch (\Exception $ex) {

            DB::rollBack();

            return JsonApiResponse::response($ex->getCode(), false, $ex->getMessage(), ['file' => $ex->getFile()]);

        }
    }

    /**
     * update order status to cancel
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function updateOrderStatusToCancel(string $uuid)
    {
        $process = app('CancelOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);


        return JsonApiResponse::success($process['message'], $process['data']);
    }

    /**
     * update order status to paid
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function updateOrderStatusToPaid(string $uuid)
    {
        DB::beginTransaction();

        try {
            $process = app('PaidOrder')->execute([
                'pesanan_uuid' => $uuid,
            ]);

            if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

            DB::commit();

            return JsonApiResponse::success($process['message'], $process['data']);
        } catch (\Exception $ex) {
            DB::rollBack();

            return JsonApiResponse::response($ex->getCode(), false, $ex->getMessage(), ['file' => $ex->getFile()]);
        }
    }

    /**
     * delete specific order data.
     *
     * @return JsonResponse
     */
    public function deleteSpecificOrder(string $uuid)
    {
        $process = app('DeleteOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], ['uuid' => $uuid]);
    }

    /**
     * display related product order data.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function showRelatedOrderedProduct(string $uuid)
    {
        $find_order = Pesanan::where('uuid', $uuid)->first();

        if (empty($find_order)) return JsonApiResponse::notFound('Pesanan Tidak Ditemukan', []);

        $ordered_products = ProdukPesanan::where('pesanan_id', $find_order->id)->get();

        if ($ordered_products->count() < 1) return JsonApiResponse::notFound('Pesanan Produk Belum Memiliki Data', []);

        return JsonApiResponse::success('Data Produk Pesanan Berhasil Diambil', [
            'pesanan' => $find_order,
            'produk_pesanan' => $ordered_products
        ]);
    }

    /**
     * display order trashed data.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function trashedOrderView(string $uuid)
    {
        $find_order = Pesanan::where('uuid', $uuid)->first();

        if (empty($find_order)) return JsonApiResponse::notFound('Pesanan Tidak Ditemukan', []);

        $trashed_ordered_products = ProdukPesanan::onlyTrashed()->where('pesanan_id', $find_order->id)->get();

        if ($trashed_ordered_products->count() < 1) return JsonApiResponse::notFound('Pesanan Produk Belum Memiliki Data', []);

        return JsonApiResponse::success('Data Produk Pesanan Yang Dihapus Berhasil Diambil', [
            'pesanan' => $find_order,
            'produk_pesanan_terhapus' => $trashed_ordered_products,
        ]);
    }

    /**
     * soft delete specified ordered product
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return JsonResponse
     */
    public function softDeleteOrderedProduct(string $order_uuid, string $order_product_uuid)
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();

        if (empty($find_order)) return JsonApiResponse::notFound('Pesanan Tidak Ditemukan', []);

        $process = app('DeleteOrderedProduct')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound('Produk Pesanan Tidak Ditemukan', []);

        return JsonApiResponse::success($process['message'], ['produk_pesanan_uuid' => $order_product_uuid]);
    }

    /**
     * restore trashed product data.
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return JsonResponse
     */
    public function restoreTrashedOrderedProduct(string $order_uuid, string $order_product_uuid)
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();

        if (empty($find_order)) return JsonApiResponse::notFound('Pesanan Tidak Ditemukan', []);

        $process = app('RestoreOrderedProduct')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound('Produk Pesanan Tidak Ditemukan', []);

        return JsonApiResponse::success($process['message'], $process['data']);
    }

    /**
     * delete specified product permanently.
     *
     * @param string $order_uuid
     * @param string $order_product_uuid
     * @return JsonResponse
     */
    public function deleteOrderedProductPermanently(string $order_uuid, string $order_product_uuid)
    {
        $find_order = Pesanan::where('uuid', $order_uuid)->first();

        if (empty($find_order)) return JsonApiResponse::notFound('Pesanan Tidak Ditemukan', []);

        $process = app('DeleteOrderedProductPermanently')->execute([
            'order_id' => $find_order->id,
            'ordered_product_uuid' => $order_product_uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound('Produk Pesanan Tidak Ditemukan', []);

        return JsonApiResponse::success($process['message'], ['produk_pesanan_uuid' => $order_product_uuid]);
    }
}
