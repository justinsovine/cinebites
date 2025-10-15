<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CineBites API routes
Route::prefix('v1')->group(function () {
    
    // Authentication routes
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/validate-passcode', [AuthController::class, 'validatePasscode']);
    
    // Event routes
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/current', [EventController::class, 'current']); // Fixed this
    Route::resource('events', EventController::class);
    
    // Menu routes
    Route::get('/menu', [MenuController::class, 'index']);
    Route::resource('menu', MenuController::class);
    
    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::resource('orders', OrderController::class);
    
    // Admin routes (protect these with auth middleware later)
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/orders', [AdminController::class, 'orders']);
        Route::get('/inventory', [AdminController::class, 'inventory']);
        Route::get('/analytics', [AdminController::class, 'analytics']);
        Route::patch('/orders/{id}/status', [AdminController::class, 'updateOrderStatus']);
    });
});