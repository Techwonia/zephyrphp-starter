<?php

/**
 * Security Configuration
 *
 * Content Security Policy, HSTS, CORS, and rate limiting settings.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Content Security Policy (CSP)
    |--------------------------------------------------------------------------
    */
    'csp' => [
        'enabled' => env('CSP_ENABLED', true),
        'level' => env('CSP_LEVEL', 'moderate'), // strict, moderate, relaxed
        'use_nonces' => env('CSP_USE_NONCES', true),
        'report_only' => false,
        'report_uri' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Strict Transport Security (HSTS)
    |--------------------------------------------------------------------------
    */
    'hsts' => [
        'enabled' => env('HSTS_ENABLED', true),
        'max_age' => 31536000, // 1 year
        'include_subdomains' => true,
        'preload' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS)
    |--------------------------------------------------------------------------
    */
    'cors' => [
        'allowed_origins' => ['*'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
        'max_age' => 86400,
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    */
    'rate_limit' => [
        'enabled' => env('RATE_LIMIT_ENABLED', true),
        'default' => [
            'max_attempts' => 60,
            'decay_seconds' => 60,
        ],
    ],
];
