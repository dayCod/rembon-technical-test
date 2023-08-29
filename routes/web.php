<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginFormView'])->name('login-view');
        Route::get('register', [RegisterController::class, 'registerFormView'])->name('register-view');
    });

});


