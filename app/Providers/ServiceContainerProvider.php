<?php

namespace App\Providers;

use App\Services\Auth\DefaultLogin;
use App\Services\Auth\DefaultLogout;
use App\Services\Auth\LoginWithOauthToken;
use App\Services\Auth\LogoutFromOauthToken;
use App\Services\Order\CancelOrder;
use App\Services\Order\CreateOrder;
use App\Services\Order\DeleteOrder;
use App\Services\Order\DeleteOrderedProduct;
use App\Services\Order\PaidOrder;
use App\Services\Order\RestoreOrderedProduct;
use App\Services\Order\UpdateOrder;
use App\Services\Product\CreateProduct;
use App\Services\Product\DeleteProductPermanently;
use App\Services\Product\RestoreProduct;
use App\Services\Product\SoftDeleteProduct;
use App\Services\Product\UpdateProduct;
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
        $this->registerService('LoginWithOauthToken', LoginWithOauthToken::class);
        $this->registerService('LogoutFromOauthToken', LogoutFromOauthToken::class);

        $this->registerService('CreateUser', CreateUser::class);

        $this->registerService('CreateProduct', CreateProduct::class);
        $this->registerService('UpdateProduct', UpdateProduct::class);
        $this->registerService('SoftDeleteProduct', SoftDeleteProduct::class);
        $this->registerService('RestoreProduct', RestoreProduct::class);
        $this->registerService('DeleteProductPermanently', DeleteProductPermanently::class);

        $this->registerService('CreateOrder', CreateOrder::class);
        $this->registerService('UpdateOrder', UpdateOrder::class);
        $this->registerService('PaidOrder', PaidOrder::class);
        $this->registerService('CancelOrder', CancelOrder::class);
        $this->registerService('DeleteOrder', DeleteOrder::class);
        $this->registerService('DeleteOrderedProduct', DeleteOrderedProduct::class);
        $this->registerService('RestoreOrderedProduct', RestoreOrderedProduct::class);
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
