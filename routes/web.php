<?php

/**
 * Web Routes
 *
 * Define your application routes here.
 */

use ZephyrPHP\Router\Route;
use App\Controllers\HomeController;

// Home page
Route::get('/', [HomeController::class, 'index']);
