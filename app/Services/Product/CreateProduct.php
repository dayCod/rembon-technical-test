<?php

namespace App\Services\Product;

use App\Models\Produk;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class CreateProduct extends BaseService implements BaseServiceInterface
{
    /**
     * create product process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $create_product = Produk::create([
            'nama' => $dto['nama'],
            'brand' => $dto['brand'],
            'harga' => $dto['harga'],
        ]);

        $product_stock = $create_product->stokProduk()->create([
            'produk_id' => $create_product->id,
            'stok' => $dto['stok'],
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'Produk Berhasil Dibuat';
        $this->results['data'] = [
            'product' => $create_product,
            'product_stock' => $product_stock,
        ];
    }
}
