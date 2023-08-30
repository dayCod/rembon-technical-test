<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
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
    });

    Route::get('/logout', [LogoutController::class, 'authenticatedUserLogout'])->middleware(['auth:api']);
});


