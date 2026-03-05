<?php

/**
 * Web Routes
 *
 * Define your application routes here.
 */

use ZephyrPHP\Router\Route;
use ZephyrPHP\Middleware\AuthMiddleware;
use ZephyrPHP\Middleware\GuestMiddleware;
use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Setup\SetupController;

// Setup wizard (only available when not installed)
if (!file_exists(BASE_PATH . '/storage/.installed')) {
    Route::get('/setup', [SetupController::class, 'index']);
    Route::post('/setup/save-settings', [SetupController::class, 'saveSettings']);
    Route::post('/setup/save-database', [SetupController::class, 'saveDatabase']);
    Route::post('/setup/test-db', [SetupController::class, 'testDatabase']);
    Route::post('/setup/create-db', [SetupController::class, 'createDatabase']);
    Route::post('/setup/install-tables', [SetupController::class, 'installTables']);
    Route::post('/setup/create-admin', [SetupController::class, 'createAdmin']);
    Route::post('/setup/complete', [SetupController::class, 'complete']);
}

// Home page
Route::get('/', [HomeController::class, 'index']);

// Guest routes (redirect to /cms if already authenticated)
Route::get('/login', [LoginController::class, 'showLoginForm'], [GuestMiddleware::class]);
Route::post('/login', [LoginController::class, 'login'], [GuestMiddleware::class]);
Route::get('/register', [RegisterController::class, 'showRegisterForm'], [GuestMiddleware::class]);
Route::post('/register', [RegisterController::class, 'register'], [GuestMiddleware::class]);

// Auth routes
Route::post('/logout', [LoginController::class, 'logout'], [AuthMiddleware::class]);
Route::get('/logout', [LoginController::class, 'logout'], [AuthMiddleware::class]);
