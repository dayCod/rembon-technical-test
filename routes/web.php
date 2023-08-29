<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backside\DashboardController;
use App\Http\Controllers\Backside\ProductController;
use Illuminate\Support\Facades\Route;


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
        Route::get('/create', [ProductController::class, 'createProductFormView'])->name('create-view');
        Route::get('/{uuid}/edit', [ProductController::class, 'editProductFormView'])->name('edit-view');
        Route::get('/{uuid}/trash', [ProductController::class, 'trashedProductView'])->name('trash-view');
    });
});


