<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Backside\ProductController;
use App\Http\Controllers\Api\Backside\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::middleware(['guest:api'])->group(function () {
        Route::post('/login', [LoginController::class, 'authenticateCredential']);
        Route::post('/register', [RegisterController::class, 'registUserAndStoreToUserTable']);
    });

    Route::get('/logout', [LogoutController::class, 'authenticatedUserLogout'])->middleware(['auth:api']);
});

/*
|--------------------------------------------------------------------------
| Backside Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'backside', 'as' => 'backside.', 'middleware' => ['auth:api']], function () {

    // Product
    Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['role.api:seller']], function () {
        Route::get('/', [ProductController::class, 'showAllProduct']);
        Route::get('/not-empty', [ProductController::class, 'showAllNotEmptyProduct']);
        Route::post('/create', [ProductController::class, 'storeProductToProdukTable']);
        Route::get('/trash', [ProductController::class, 'showAllTrashedProduct']);
        Route::get('/{uuid}/edit', [ProductController::class, 'findSpecificProduct']);
        Route::put('/{uuid}/update', [ProductController::class, 'updateProductAction']);
        Route::delete('/{uuid}/delete', [ProductController::class, 'softDeleteProduct']);
        Route::get('/{uuid}/restore', [ProductController::class, 'restoreTrashedProduct']);
        Route::delete('/{uuid}/force-delete', [ProductController::class, 'deleteProductPermanently']);
    });

    // Order
    Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => ['role.api:buyer']], function () {
        Route::get('/', [OrderController::class, 'showAllOrders']);
        Route::post('/create', [OrderController::class, 'storeOrderToPesananAndProdukPesananTable']);
        Route::get('/{uuid}/edit', [OrderController::class, 'findSpecificOrder']);
        Route::put('/{uuid}/update', [OrderController::class, 'updateProductAction']);
        Route::get('/{uuid}/cancel', [OrderController::class, 'updateOrderStatusToCancel']);
        Route::get('/{uuid}/paid-off', [OrderController::class, 'updateOrderStatusToPaid']);
        Route::delete('/{uuid}/delete', [OrderController::class, 'deleteSpecificOrder']);
    });

});

