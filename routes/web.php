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
