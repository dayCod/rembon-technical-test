<?php

namespace App\Providers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\ProdukPesanan;
use App\Models\StokProduk;
use App\Models\User;
use App\Observers\PesananModelObserver;
use App\Observers\ProdukModelObserver;
use App\Observers\ProdukPesananModelObserver;
use App\Observers\StokProdukModelObserver;
use App\Observers\UserModelObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // User Model Observer
        User::observe(UserModelObserver::class);

        // Produk Model Observer
        Produk::observe(ProdukModelObserver::class);

        // Stok Produk Model Observer
        StokProduk::observe(StokProdukModelObserver::class);

        // Pesanan Model Observer
        Pesanan::observe(PesananModelObserver::class);

        // Produk Pesanan Model Observer
        ProdukPesanan::observe(ProdukPesananModelObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
