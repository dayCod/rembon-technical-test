<?php

namespace App\Observers;

use App\Models\StokProduk;

class StokProdukModelObserver
{
    /**
     * Handle the StokProduk "updated" event.
     */
    public function updating(StokProduk $stokProduk): void
    {
        $stokProduk->tgl_diubah = now();
    }
}
