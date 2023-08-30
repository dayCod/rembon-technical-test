<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * get user full name.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }

    /**
     * has one relation between user and order.
     *
     * @return HasManyRelation
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'user_id', 'id');
    }
}
