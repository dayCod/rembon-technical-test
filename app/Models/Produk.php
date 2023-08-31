<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Mst.produk';

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
     * has one relation between product and stock of product.
     *
     * @return HasOneRelation
     */
    public function stokProduk(): HasOne
    {
        return $this->hasOne(StokProduk::class, 'produk_id', 'id');
    }

    /**
     * has many relation between product and product order.
     *
     * @return HasManyRelation
     */
    public function produkPesanan(): HasMany
    {
        return $this->hasMany(ProdukPesanan::class, 'produk_id', 'id');
    }
}
