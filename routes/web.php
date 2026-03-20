<?php

/**
 * Web Routes
 *
 * Define your application routes here.
 */

use ZephyrPHP\Router\Route;
use ZephyrPHP\Middleware\AuthMiddleware;
use ZephyrPHP\Middleware\GuestMiddleware;
use App\Controllers\Auth\LoginController;
use App\Setup\SetupController;

// Setup wizard (only available when not installed)
if (!file_exists(BASE_PATH . '/storage/.installed')) {
    Route::get('/setup', [SetupController::class, 'index']);
    Route::post('/setup/save-settings', [SetupController::class, 'saveSettings']);
    Route::post('/setup/setup-database', [SetupController::class, 'setupDatabase']);
    Route::post('/setup/create-admin', [SetupController::class, 'createAdmin']);
    Route::post('/setup/complete', [SetupController::class, 'complete']);
}

// Guest routes (redirect to /cms if already authenticated)
Route::get('/login', [LoginController::class, 'showLoginForm'], [GuestMiddleware::class]);
Route::post('/login', [LoginController::class, 'login'], [GuestMiddleware::class]);
// Auth routes
Route::post('/logout', [LoginController::class, 'logout'], [AuthMiddleware::class]);
