<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backside\DashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginFormView'])->name('login-view');
        Route::get('register', [RegisterController::class, 'registerFormView'])->name('register-view');
    });
});

/*
|--------------------------------------------------------------------------
| Backside Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'backside', 'as' => 'backside.'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboardPageView'])->name('index');
});


