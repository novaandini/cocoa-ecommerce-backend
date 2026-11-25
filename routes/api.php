<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', EnsureUserIsAdmin::class])
    ->get('products/export', [ProductController::class, 'export'])
    ->name('products.export');

Route::apiResource('products', ProductController::class)->only(['index', 'show']);

Route::middleware(['auth:sanctum', EnsureUserIsAdmin::class])
    ->apiResource('products', ProductController::class)
    ->except(['index', 'show']);

Route::middleware(['auth:sanctum', EnsureUserIsAdmin::class])->group(function (): void {
    Route::apiResource('customers', CustomerController::class)->only(['index', 'show', 'update']);
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'update']);
});
