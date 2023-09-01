<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukPesanan extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Trx.produk_pesanan';

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
     * The attributes that are mass protected with dates.
     *
     * @var array<int, string>
     */
    protected $dates = ['tgl_dihapus'];

    /**
     * custom static deleted_at on soft delete traits.
     *
     * @var string
     */
    const DELETED_AT = 'tgl_dihapus';

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
