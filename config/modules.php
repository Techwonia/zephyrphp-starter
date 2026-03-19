<?php

/**
 * Module Configuration
 *
 * Enable or disable optional framework modules.
 * Only enabled modules will be loaded, reducing memory footprint
 * and improving performance for applications that don't need all features.
 *
 * Install modules via Composer:
 *   composer require zephyrphp/cache
 *
 * Then enable them here by setting to true.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Core Modules (Always Available)
    |--------------------------------------------------------------------------
    */

    // Session management - Required for flash messages, CSRF, auth
    'session' => true,

    // Input validation
    'validation' => true,

    // Template rendering with Twig
    'view' => true,

    /*
    |--------------------------------------------------------------------------
    | Installed Modules
    |--------------------------------------------------------------------------
    |
    | These modules are included with the starter.
    | Set to false to disable any module you don't need.
    |
    */

    // Database - Doctrine ORM integration
    'database' => true,

    // Authentication - Session and JWT auth
    'auth' => true,

    // Authorization - Gates and Policies
    'authorization' => true,

    // CMS - Content Management System
    'cms' => true,

    /*
    |--------------------------------------------------------------------------
    | Optional Modules (Require Installation)
    |--------------------------------------------------------------------------
    |
    | Install with: composer require zephyrphp/<module>
    |
    */

    // Cache - Multiple cache drivers (file, redis, apcu, array)
    // Install: composer require zephyrphp/ cache
    'cache' => false,

    // Mail - Email sending (smtp, mail, log)
    // Install: composer require zephyrphp/ mail
    'mail' => false,

    // Queue - Background job processing (sync, database, redis, file)
    // Install: composer require zephyrphp/ queue
    'queue' => false,
];
