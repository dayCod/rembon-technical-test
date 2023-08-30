<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
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


