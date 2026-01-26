<?php

/**
 * Web Routes
 *
 * Define your application routes here.
 */

use ZephyrPHP\Router\Route;

// Home page
Route::get('/', function () {
    return view('welcome');
});
