<?php

namespace App\Services\Order;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class PaidOrder extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to paid process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_order = Pesanan::with('produkPesanan')->where('uuid', $dto['pesanan_uuid'])->first();

        if (!empty($find_order)) {

            $group_order_by_of_his_product = $find_order->produkPesanan->groupBy('produk_id')->mapWithKeys(function ($item, $key) {
                return [
                    $key => collect($item)->sum('jumlah'),
                ];
            });
            $group_order_by_of_his_product->each(function ($product_amount, $product_id) {
                $find_related_product = Produk::with('stokProduk')->where('id', $product_id)->first();
                $find_related_product->stokProduk->update([
                    'stok' => $find_related_product->stokProduk->stok - $product_amount,
                ]);
            });

            $find_order->update([
                'tgl_pembayaran_lunas' => now(),
                'tgl_dibatalkan' => null,
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Pesanan Berhasil Di Lunasi';
            $this->results['data'] = $find_order;
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
