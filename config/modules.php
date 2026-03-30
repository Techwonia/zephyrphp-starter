<?php

/**
 * Module Configuration
 *
 * Enable or disable framework modules. Core modules (session, validation, view)
 * are always available. Optional modules can be toggled here.
 *
 * Install modules via Composer:
 *   composer require zephyrphp/database
 *   composer require zephyrphp/auth
 *   composer require zephyrphp/authorization
 *   composer require zephyrphp/cache
 */

return [
    // Optional modules — set to true to enable
    'database' => false,
    'auth' => false,
    'authorization' => false,
    'cache' => false,
    'mail' => false,
    'queue' => false,
];
