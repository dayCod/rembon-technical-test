<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pesanan';

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
     * has many relation between order and product order.
     *
     * @return HasManyRelation
     */
    public function produkPesanan(): HasMany
    {
        return $this->hasMany(ProdukPesanan::class, 'pesanan_id', 'id');
    }

    /**
     * belongs to relation between order and product order.
     *
     * @return BelongsToRelation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * get total price of product order.
     *
     * @return string
     */
    public function getTotalPriceOfProductOrder(): string
    {
        $sum_total_price = $this->produkPesanan()->withSum('produk', 'harga')->get()->mapWithKeys(function ($value, $index) {
            return [
                $index => ['total_harga' => $value['produk_sum_harga'] * $value['jumlah']],
            ];
        })->pluck('total_harga')->sum();


        return 'Rp. '.number_format($sum_total_price, 2, '.', ',');
    }

    /**
     * get total price of product order.
     *
     * @return int
     */
    public function countTotalOrderedProduct(): int
    {
        return $this->produkPesanan()->pluck('jumlah')->sum();
    }

    /**
     * get order status.
     *
     * @return string
     */
    public function getOrderStatus(): string
    {
        return (is_null($this->tgl_pembayaran_lunas) && is_null($this->tgl_dibatalkan))
            ? 'Pending'
            : ((!is_null($this->tgl_pembayaran_lunas) && is_null($this->tgl_dibatalkan))
                    ? 'Lunas'
                    : 'Batal');
    }

}
