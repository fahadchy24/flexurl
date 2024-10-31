<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.v1.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
        Route::get('short-urls', [ShortUrlController::class, 'userUrls'])->name('short-urls.show');


        Route::post('logout', [AuthController::class, 'logout']);
    });
});
