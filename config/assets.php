<?php

/**
 * Asset Configuration
 *
 * Versioning, CDN, minification, and asset bundling settings.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Version Strategy
    |--------------------------------------------------------------------------
    | Options: timestamp, hash, manifest, global, none
    */
    'version' => 'timestamp',

    /*
    |--------------------------------------------------------------------------
    | CDN Configuration
    |--------------------------------------------------------------------------
    */
    'cdn' => [
        'enabled' => false,
        'url' => env('CDN_URL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Minification
    |--------------------------------------------------------------------------
    | Automatically minify CSS/JS in production if matthiasmullie/minify is installed.
    */
    'minify' => [
        'enabled' => env('ENV', 'dev') === 'production',
    ],

    /*
    |--------------------------------------------------------------------------
    | Asset Collections (Bundles)
    |--------------------------------------------------------------------------
    | Named bundles that can be loaded with Asset::collection('name')
    */
    'collections' => [
        'core' => [
            ['type' => 'css', 'path' => 'css/app.css', 'priority' => 10],
            ['type' => 'js', 'path' => 'js/app.js', 'priority' => 10],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preload / Preconnect
    |--------------------------------------------------------------------------
    */
    'preload' => [],
    'preconnect' => [],
];
