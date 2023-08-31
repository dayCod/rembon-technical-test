<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * belongs to relation between order and product order.
     *
     * @return BelongsToRelation
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    /**
     * belongs to relation between order product and order.
     *
     * @return BelongsToRelation
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}
