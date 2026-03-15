<?php

/**
 * Asset Configuration
 *
 * Global settings for how ZephyrPHP handles asset URLs (versioning, CDN, minification).
 *
 * Theme-specific assets (CSS, JS, preload, preconnect, CSP) are configured
 * per-theme in theme.json — not here.
 *
 * USAGE IN TEMPLATES:
 * - {{ asset('css/app.css') }}  — Versioned URL
 * - {{ css('css/app.css') }}    — Full <link> tag
 * - {{ js('js/app.js') }}       — Full <script> tag
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Asset Versioning Strategy
    |--------------------------------------------------------------------------
    |
    | Controls how ?v= is appended to asset URLs for cache busting.
    |
    | Options:
    | - 'timestamp'  — File modification time (good for development)
    | - 'hash'       — MD5 of file content (best for production)
    | - 'manifest'   — Read from build tool manifest.json (Vite/Webpack)
    | - 'global'     — Single version string for all assets
    | - 'none'       — No versioning
    |
    */
    'version_strategy' => env('ASSET_VERSION_STRATEGY', 'timestamp'),

    /*
    |--------------------------------------------------------------------------
    | Global Version String
    |--------------------------------------------------------------------------
    |
    | Used only when version_strategy = 'global'.
    | Increment this on deploy to bust all caches at once.
    |
    */
    'global_version' => env('ASSET_VERSION', '1.0.0'),

    /*
    |--------------------------------------------------------------------------
    | CDN Configuration
    |--------------------------------------------------------------------------
    |
    | Prefix all asset URLs with a CDN domain (CloudFlare, AWS CloudFront, etc.)
    | Leave null to serve assets from your own server.
    |
    */
    // 'cdn_url' => env('ASSET_CDN_URL', null),
    // 'cdn_enabled' => env('ASSET_CDN_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Auto-Minify
    |--------------------------------------------------------------------------
    |
    | When enabled, automatically serves .min.css / .min.js versions in
    | production. Use the CMS "Minify Now" button or the craftsman command
    | to generate minified files.
    |
    */
    // 'minify' => env('ASSET_MINIFY', false),

    /*
    |--------------------------------------------------------------------------
    | Build Manifest
    |--------------------------------------------------------------------------
    |
    | Path to manifest.json from Vite, Webpack, or other build tools.
    | Only needed when version_strategy = 'manifest'.
    |
    */
    // 'manifest' => env('ASSET_MANIFEST', 'build/manifest.json'),
];
