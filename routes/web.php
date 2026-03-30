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
use App\Controllers\Auth\PasswordResetController;
use App\Controllers\Auth\InvitationController;
// Setup wizard (only available when not installed)
if (!file_exists(BASE_PATH . '/storage/.installed') && class_exists(\App\Setup\SetupController::class)) {
    Route::get('/setup', [\App\Setup\SetupController::class, 'index']);
    Route::post('/setup/save-settings', [\App\Setup\SetupController::class, 'saveSettings']);
    Route::post('/setup/setup-database', [\App\Setup\SetupController::class, 'setupDatabase']);
    Route::post('/setup/create-admin', [\App\Setup\SetupController::class, 'createAdmin']);
}

// Auth routes
Route::get('/zephyrphp/auth/login', [LoginController::class, 'showLoginForm'], [GuestMiddleware::class]);
Route::post('/zephyrphp/auth/login', [LoginController::class, 'login'], [GuestMiddleware::class]);
Route::post('/zephyrphp/auth/logout', [LoginController::class, 'logout'], [AuthMiddleware::class]);

// Password reset routes
Route::get('/zephyrphp/auth/forgot-password', [PasswordResetController::class, 'showForgotForm'], [GuestMiddleware::class]);
Route::post('/zephyrphp/auth/forgot-password', [PasswordResetController::class, 'sendResetLink'], [GuestMiddleware::class]);
Route::get('/zephyrphp/auth/reset-password', [PasswordResetController::class, 'showResetForm'], [GuestMiddleware::class]);
Route::post('/zephyrphp/auth/reset-password', [PasswordResetController::class, 'resetPassword'], [GuestMiddleware::class]);

// Invitation acceptance routes
Route::get('/zephyrphp/auth/invite/accept', [InvitationController::class, 'showAcceptForm'], [GuestMiddleware::class]);
Route::post('/zephyrphp/auth/invite/accept', [InvitationController::class, 'accept'], [GuestMiddleware::class]);
