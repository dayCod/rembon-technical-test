<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stok_produk';

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
