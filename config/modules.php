<?php

/**
 * Module Configuration
 *
 * Enable or disable optional framework modules.
 * Only enabled modules will be loaded, reducing memory footprint
 * and improving performance for applications that don't need all features.
 *
 * Install/Remove modules via Craftsman:
 *   php craftsman add cache
 *   php craftsman remove mail
 *
 * Enable/Disable via Craftsman:
 *   php craftsman module:enable cache
 *   php craftsman module:disable mail
 *   php craftsman module:list
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
    | Install with: php craftsman add <module>
    |
    */

    // Cache - Multiple cache drivers (file, redis, apcu, array)
    // Install: php craftsman add cache
    'cache' => false,

    // Mail - Email sending (smtp, mail, log)
    // Install: php craftsman add mail
    'mail' => false,

    // Queue - Background job processing (sync, database, redis, file)
    // Install: php craftsman add queue
    'queue' => false,
];
