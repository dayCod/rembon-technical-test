<?php

namespace App\Observers;

use App\Models\ProdukPesanan;
use Illuminate\Support\Str;

class ProdukPesananModelObserver
{
    /**
     * Handle the creating product_order before created process.
     */
    public function creating(ProdukPesanan $produk_pesanan): void
    {
        $produk_pesanan->uuid = Str::uuid();
        $produk_pesanan->tgl_dibuat = now();
    }
}
