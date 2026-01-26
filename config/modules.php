<?php

/**
 * Module Configuration
 *
 * Enable or disable optional framework modules.
 * Only enabled modules will be loaded, reducing memory footprint
 * and improving performance for applications that don't need all features.
 *
 * IMPORTANT: Optional modules (database, auth, authorization, cache, mail, queue)
 * must be installed first using: php craftsman add <module>
 *
 * Usage:
 *   - Set to true to enable a module
 *   - Set to false to disable a module
 *
 * Install/Remove modules via Craftsman:
 *   php craftsman add database
 *   php craftsman add auth
 *   php craftsman remove mail
 *
 * List available modules:
 *   php craftsman add
 *
 * Enable/Disable via Craftsman:
 *   php craftsman module:enable database
 *   php craftsman module:disable mail
 *   php craftsman module:list
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Core Modules (Always Available)
    |--------------------------------------------------------------------------
    |
    | These modules are built into the framework and don't require installation.
    |
    */

    // Session management - Required for flash messages, CSRF, auth
    'session' => true,

    // Input validation
    'validation' => true,

    // Template rendering with Twig
    'view' => true,

    /*
    |--------------------------------------------------------------------------
    | Optional Modules (Require Installation)
    |--------------------------------------------------------------------------
    |
    | These modules are separate packages. Install them first:
    |   php craftsman add <module>
    |
    | Then enable them here.
    |
    */

    // Database - Doctrine ORM integration
    // Install: php craftsman add database
    'database' => false,

    // Authentication - Session and JWT auth
    // Install: php craftsman add auth
    // Requires: session
    'auth' => false,

    // Authorization - Gates and Policies
    // Install: php craftsman add authorization
    // Requires: auth
    'authorization' => false,

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
