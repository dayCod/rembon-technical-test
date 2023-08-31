<?php

namespace App\Http\Controllers\Api\Backside;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateAndUpdateOrderRequest;
use App\Http\Response\JsonApiResponse;
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
     * display all orders.
     *
     * @return JsonResponse
     */
    public function showAllOrders()
    {
        $orders = Pesanan::with('produkPesanan', 'user')->orderBy('id', 'desc')->get();

        if ($orders->count() < 1) return JsonApiResponse::notFound('Data Pesanan Tidak Ditemukan', []);

        return JsonApiResponse::success('Data Pesanan Berhasil Diambil', $orders->toArray());
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
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            return JsonApiResponse::unauthorized('Pesanan Sudah Tidak Dapat Di Update', []);
        }

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
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            return JsonApiResponse::unauthorized('Pesanan Sudah Tidak Dapat Di Update', []);
        }

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
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            return JsonApiResponse::unauthorized('Pesanan Sudah Tidak Dapat Di Update', []);
        }

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
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() != "Pending") {
            return JsonApiResponse::unauthorized('Pesanan Sudah Tidak Dapat Di Update', []);
        }

        $process = app('PaidOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], $process['data']);
    }

    /**
     * delete specific order data.
     *
     * @return JsonResponse
     */
    public function deleteSpecificOrder(string $uuid)
    {
        // Not Allowed if Status is'nt Pending
        if (Pesanan::where('uuid', $uuid)->first()->getOrderStatus() == "Pending") {
            return JsonApiResponse::unauthorized('Pesanan Sudah Tidak Dapat Di Hapus', []);
        }

        $process = app('DeleteOrder')->execute([
            'pesanan_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], ['uuid' => $uuid]);
    }
}
