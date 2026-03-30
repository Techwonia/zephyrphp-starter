<?php

/**
 * Session Configuration
 */

return [
    'name' => 'zephyr_session',
    'lifetime' => (int) env('SESSION_LIFETIME', 120) * 60,
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', true),
    'httponly' => true,
    'samesite' => 'Lax',
];
