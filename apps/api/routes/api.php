<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Your CineBites API routes will go here
Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('/auth/login', [AuthController::class, 'login']);
    
    // Events
    Route::get('/events/current', [EventController::class, 'current']);
    
    // Menu
    Route::get('/menu', [MenuController::class, 'index']);
    
    // Orders
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
});