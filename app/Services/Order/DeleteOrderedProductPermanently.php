<?php

namespace App\Services\Order;

use App\Models\Pesanan;
use App\Models\ProdukPesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class DeleteOrderedProductPermanently extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to cancel process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_ordered_product = ProdukPesanan::onlyTrashed()->where('uuid', $dto['ordered_product_uuid'])->where('pesanan_id', $dto['order_id'])->first();

        if (!empty($find_ordered_product)) {

            $find_order = Pesanan::where('id', $dto['order_id'])->first();
            $ordered_product = ProdukPesanan::where('pesanan_id', $dto['order_id'])->count();
            $trashed_order_product = ProdukPesanan::onlyTrashed()->where('pesanan_id', $dto['order_id'])->count();

            if (($ordered_product + $trashed_order_product) < 2) {
                $find_order->update(['tgl_dibatalkan' => now()]);
            };

            $find_ordered_product->forceDelete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Produk Pesanan Berhasil Di Hapus Secara Permanen';
            $this->results['data'] = [
                'produk_pesanan' => $find_ordered_product,
                'pesanan' => $find_order
            ];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Produk Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
