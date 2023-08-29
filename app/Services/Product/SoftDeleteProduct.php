<?php

namespace App\Services\Product;

use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use App\Models\Produk;

class SoftDeleteProduct extends BaseService implements BaseServiceInterface
{
    /**
     * soft delete product process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_product = Produk::with('stokProduk')->where('uuid', $dto['produk_uuid'])->first();

        if (!empty($find_product)) {
            $find_product->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Produk Berhasil Dihapus';
            $this->results['data'] = $find_product;
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Produk Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
