<?php

/**
 * ZephyrPHP - Light as a breeze, fast as the wind.
 *
 * This is the entry point for all requests to your ZephyrPHP application.
 */

define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);
define('ZEPHYR_START', microtime(true));

// Autoload dependencies
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

// Load application bootstrap (custom exception handlers, services, etc.)
$bootstrapFile = BASE_PATH . '/bootstrap/app.php';
if (file_exists($bootstrapFile)) {
    require $bootstrapFile;
}

// Create and run the application
$app = new ZephyrPHP\Core\Application();
$app->run();
