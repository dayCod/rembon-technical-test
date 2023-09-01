<?php

namespace App\Services\Order;

use App\Models\Pesanan;
use App\Models\ProdukPesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class DeleteOrderedProduct extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to cancel process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_ordered_product = ProdukPesanan::where('uuid', $dto['ordered_product_uuid'])->where('pesanan_id', $dto['order_id'])->first();

        if (!empty($find_ordered_product)) {
            $find_ordered_product->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Produk Pesanan Berhasil Di Hapus';
            $this->results['data'] = [
                'produk_pesanan' => $find_ordered_product,
            ];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Produk Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
