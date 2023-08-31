<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backside\DashboardController;
use App\Http\Controllers\Backside\OrderController;
use App\Http\Controllers\Backside\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Default Redirected Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('auth.login-view');
});

/*
|--------------------------------------------------------------------------
| Rembon Test Routes
|--------------------------------------------------------------------------
*/
Route::get('/show-product', function () {
    return view('test.product');
});

Route::get('/show-order', function () {
    return view('test.order');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'loginFormView'])->name('login-view');
        Route::post('/login', [LoginController::class, 'authenticateCredential'])->name('authenticate-user');
        Route::get('/register', [RegisterController::class, 'registerFormView'])->name('register-view');
        Route::post('/register', [RegisterController::class, 'registUserAndStoreToUserTable'])->name('register-action');
    });

    Route::get('/logout', [LogoutController::class, 'authenticatedUserLogout'])->middleware(['auth'])->name('user-logout');
});

/*
|--------------------------------------------------------------------------
| Backside Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'backside', 'as' => 'backside.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardPageView'])->name('dashboard');

    // Product
    Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['role:seller']], function () {
        Route::get('/', [ProductController::class, 'productIndexView'])->name('index-view');
        Route::get('/trash', [ProductController::class, 'trashedProductView'])->name('trash-view');
        Route::get('/create', [ProductController::class, 'createProductFormView'])->name('create-view');
        Route::post('/create', [ProductController::class, 'storeProductToProdukTable'])->name('store-action');
        Route::get('/{uuid}/edit', [ProductController::class, 'editProductFormView'])->name('edit-view');
        Route::put('/{uuid}/update', [ProductController::class, 'updateProductAction'])->name('update-action');
        Route::delete('/{uuid}/delete', [ProductController::class, 'softDeleteProduct'])->name('soft-delete');
        Route::get('/{uuid}/restore', [ProductController::class, 'restoreTrashedProduct'])->name('restore-product');
        Route::delete('/{uuid}/force-delete', [ProductController::class, 'deleteProductPermanently'])->name('force-delete');
    });

    // Order
    Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => ['role:buyer']], function () {
        Route::get('/', [OrderController::class, 'orderIndexView'])->name('index-view');
        Route::get('/create', [OrderController::class, 'createOrderFormView'])->name('create-view');
        Route::post('/create', [OrderController::class, 'storeOrderToPesananAndProdukPesananTable'])->name('store-action');
        Route::get('/{uuid}/edit', [OrderController::class, 'editOrderFormView'])->name('edit-view');
        Route::put('/{uuid}/update', [OrderController::class, 'updateProductAction'])->name('update-action');
        Route::get('/{uuid}/cancel', [OrderController::class, 'updateOrderStatusToCancel'])->name('cancel-action');
        Route::get('/{uuid}/paid-off', [OrderController::class, 'updateOrderStatusToPaid'])->name('paid-off-action');
        Route::delete('/{uuid}/delete', [OrderController::class, 'deleteSpecificOrder'])->name('delete-action');
    });
});


