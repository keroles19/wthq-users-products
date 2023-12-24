<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('admin')->middleware('access.admin')->group(function () {
        // Users
        Route::apiResource('users', UserController::class);

        // Products
        Route::apiResource('products', ProductController::class);
    });

    // get active products per user type
    Route::get('products', [ProductController::class, 'getProductByUserType']);
});
