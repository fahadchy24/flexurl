<?php

use App\Http\Controllers\Api\V2\Auth\AuthController;
use App\Http\Controllers\Api\V2\ShortUrlController;
use App\Http\Resources\V2\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v2')->name('api.v2.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return new UserResource($request->user());
        });

        Route::post('short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
        Route::get('short-urls', [ShortUrlController::class, 'userUrls'])->name('short-urls.show');

        Route::post('logout', [AuthController::class, 'logout']);
    });
});
