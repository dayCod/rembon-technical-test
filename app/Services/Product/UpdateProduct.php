<?php

namespace App\Services\Product;

use App\Models\Produk;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class UpdateProduct extends BaseService implements BaseServiceInterface
{
    /**
     * update product process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_product = Produk::with('stokProduk')->where('uuid', $dto['produk_uuid'])->first();

        if (!empty($find_product)) {
            $find_product->update([
                'nama' => $dto['nama'],
                'brand' => $dto['brand'],
                'harga' => $dto['harga'],
            ]);

            $find_product->stokProduk->update([
                'stok' => $dto['stok'],
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Produk Berhasil Diubah';
            $this->results['data'] = [
                'produk' => $find_product,
                'stok_produk' => $find_product->stokProduk,
            ];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Produk Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
