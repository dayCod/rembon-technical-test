<?php

namespace App\Observers;

use App\Models\Produk;
use Illuminate\Support\Str;

class ProdukModelObserver
{
    /**
     * Handle the creating user before created process.
     */
    public function creating(Produk $produk): void
    {
        $produk->uuid = Str::uuid();
        $produk->slug = strtolower(str_replace(' ', '-', $produk->nama)).'-'.Str::random(5);
        $produk->tgl_dibuat = now();
        $produk->tgl_rilis = now();
    }
}
