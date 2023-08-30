<?php

namespace App\Observers;

use App\Models\Pesanan;
use Illuminate\Support\Str;

class PesananModelObserver
{
    /**
     * Handle the creating order before created process.
     */
    public function creating(Pesanan $pesanan): void
    {
        $pesanan->uuid = Str::uuid();
        $pesanan->tgl_pesanan = now();
        $pesanan->kode_pesanan = Str::random(10);
    }
}
