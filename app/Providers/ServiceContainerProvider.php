<?php

namespace App\Providers;

use App\Services\Auth\DefaultLogin;
use App\Services\Auth\DefaultLogout;
use App\Services\Product\CreateProduct;
use App\Services\User\CreateUser;
use Illuminate\Support\ServiceProvider;

class ServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerService('DefaultLogin', DefaultLogin::class);
        $this->registerService('DefaultLogout', DefaultLogout::class);

        $this->registerService('CreateUser', CreateUser::class);

        $this->registerService('CreateProduct', CreateProduct::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Function for registering the exists services.
     *
     * @param string $service_name
     * @param $class_name
     * @return void
     */
    private function registerService(string $service_name, $class_name)
    {
        $this->app->singleton($service_name, function() use ($class_name) {
            return new $class_name;
        });
    }
}
