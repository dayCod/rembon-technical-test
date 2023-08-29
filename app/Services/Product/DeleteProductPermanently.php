<?php

namespace App\Services\Product;

use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use App\Models\Produk;

class DeleteProductPermanently extends BaseService implements BaseServiceInterface
{
    /**
     * delete product permanently process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_product = Produk::onlyTrashed()->with('stokProduk')->where('uuid', $dto['produk_uuid'])->first();

        if (!empty($find_product)) {
            $find_product->forceDelete();

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
