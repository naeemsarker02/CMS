<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::prefix('v1')->group(function () {
    
    // Authentication routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        
        // Profile & Logout
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);

        // Role-based protected routes examples
        
        // Super Admin only routes
        Route::middleware('role:Super Admin')->prefix('super-admin')->group(function () {
            // Super admin routes will be here
        });

        // Admin and Super Admin routes
        Route::middleware('role:Super Admin,Admin')->prefix('admin')->group(function () {
            // Admin routes will be here
        });

        // Sales Officer routes
        Route::middleware('role:Super Admin,Admin,Sales Officer')->prefix('sales')->group(function () {
            // Sales routes will be here
        });

        // Project Manager routes
        Route::middleware('role:Super Admin,Admin,Project Manager')->prefix('projects')->group(function () {
            // Project routes will be here
        });

        // Customer routes
        Route::middleware('role:Customer')->prefix('customer')->group(function () {
            // Customer routes will be here
        });
    });
});