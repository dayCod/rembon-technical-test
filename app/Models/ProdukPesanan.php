<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPesanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk_pesanan';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
}
