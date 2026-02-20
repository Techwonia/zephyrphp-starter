<?php

/**
 * Asset Configuration
 *
 * Configure how ZephyrPHP handles CSS, JavaScript, images, and other static assets.
 *
 * USAGE IN TEMPLATES:
 * - {{ css('assets/css/app.css') }} - Add a CSS file
 * - {{ js('assets/js/app.js') }} - Add a JS file
 * - {{ load_assets('app') }} - Load an asset collection
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Assets Prefix (REQUIRED)
    |--------------------------------------------------------------------------
    |
    | The folder inside /public where your assets are stored.
    | Default: 'assets' means files are in /public/assets/
    |
    */
    'assets_prefix' => 'assets',

    /*
    |--------------------------------------------------------------------------
    | Asset Versioning Strategy
    |--------------------------------------------------------------------------
    |
    | Automatically adds version numbers to asset URLs to bust browser cache.
    |
    | Options:
    | - 'timestamp': Uses file modification time (good for development)
    | - 'none': No versioning (use in development or with CDN)
    |
    | Advanced options (when you need them):
    | - 'hash': MD5 hash of file content (best for production)
    | - 'manifest': Read from build tool (Vite/Webpack) manifest.json
    | - 'global': Use single version string for all assets
    |
    */
    'version_strategy' => env('ASSET_VERSION_STRATEGY', 'timestamp'),

    /*
    |--------------------------------------------------------------------------
    | Asset Collections (RECOMMENDED)
    |--------------------------------------------------------------------------
    |
    | Group related assets together for easy loading in templates.
    | Use {{ load_assets('collection_name') }} in your Twig templates.
    |
    | REAL-LIFE EXAMPLES:
    |
    | 1. Load on specific pages:
    |    In your template: {{ load_assets('dashboard') }}
    |
    | 2. Priority determines load order (lower = earlier):
    |    - CSS: priority 1-50 (load early)
    |    - JS: priority 100+ (load late, after content)
    |
    */
    'collections' => [
        // Main app assets - loaded on every page
        'app' => [
            ['path' => 'assets/css/app.css', 'priority' => 1],
            ['path' => 'assets/js/app.js', 'priority' => 100],
        ],

        // EXAMPLES: Uncomment and customize as needed

        // Admin dashboard - only load on admin pages
        // 'dashboard' => [
        //     ['path' => 'assets/css/dashboard.css', 'priority' => 5],
        //     ['path' => 'assets/js/chart.min.js', 'priority' => 100],
        //     ['path' => 'assets/js/dashboard.js', 'priority' => 101],
        // ],

        // Blog - specific styles for blog pages
        // 'blog' => [
        //     ['path' => 'assets/css/blog.css', 'priority' => 5],
        //     ['path' => 'assets/js/prism.min.js', 'priority' => 100], // Code syntax highlighting
        // ],

        // Forms with validation
        // 'forms' => [
        //     ['path' => 'assets/css/forms.css', 'priority' => 5],
        //     ['path' => 'assets/js/validator.js', 'priority' => 100],
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ADVANCED OPTIONS (Optional - Uncomment when needed)
    |--------------------------------------------------------------------------
    */

    // Global Version String
    // Used only when version_strategy = 'global'
    // Increment this when deploying to force cache refresh
    // 'global_version' => env('ASSET_VERSION', '1.0.0'),

    // CDN Configuration (for production)
    // Serve assets from a CDN like CloudFlare or AWS CloudFront
    // Example: 'cdn_url' => 'https://cdn.yoursite.com',
    // 'cdn_url' => env('ASSET_CDN_URL', null),
    // 'cdn_enabled' => env('ASSET_CDN_ENABLED', false),

    // Auto-Minification
    // Automatically use .min.css/.min.js versions in production
    // Example: app.css becomes app.min.css
    // 'minify' => env('ASSET_MINIFY', false),

    // Build Tool Manifest
    // Path to manifest.json from Vite, Webpack, etc.
    // Only needed if using version_strategy = 'manifest'
    // 'manifest' => env('ASSET_MANIFEST', 'build/manifest.json'),

    // Preload Critical Assets (Advanced Performance)
    // Tells browser to download these files early
    // Example: Preload fonts or hero images
    // 'preload' => [
    //     ['path' => 'assets/fonts/inter-var.woff2', 'as' => 'font'],
    //     ['path' => 'assets/images/hero.webp', 'as' => 'image'],
    // ],

    // Preconnect to External Domains (Performance Boost)
    // Connect to CDNs early for faster loading
    // 'preconnect' => [
    //     ['url' => 'https://fonts.googleapis.com', 'crossorigin' => false],
    //     ['url' => 'https://cdn.yoursite.com', 'crossorigin' => true],
    // ],
];
