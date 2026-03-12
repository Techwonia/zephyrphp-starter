<?php

/**
 * AI Builder Configuration
 *
 * Configure AI providers for the page/section builder.
 * Set API keys in your .env file — do NOT hard-code them here.
 *
 * Free providers (Gemini, Groq) are available by default.
 * Self-hosted users can use Ollama for fully private, free AI.
 */

return [
    // Default provider. Change via AI_PROVIDER env var.
    // Options: gemini, claude, openai, groq, mistral, openrouter, ollama
    'default' => env('AI_PROVIDER', 'gemini'),

    'providers' => [
        'gemini' => [
            'driver' => 'gemini',
            'api_key' => env('GEMINI_API_KEY', ''),
            'model' => env('GEMINI_MODEL', 'gemini-2.0-flash'),
        ],

        'claude' => [
            'driver' => 'claude',
            'api_key' => env('ANTHROPIC_API_KEY', ''),
            'model' => env('CLAUDE_MODEL', 'claude-sonnet-4-20250514'),
        ],

        'openai' => [
            'driver' => 'openai',
            'api_key' => env('OPENAI_API_KEY', ''),
            'model' => env('OPENAI_MODEL', 'gpt-4o'),
        ],

        'groq' => [
            'driver' => 'groq',
            'api_key' => env('GROQ_API_KEY', ''),
            'model' => env('GROQ_MODEL', 'llama-3.3-70b-versatile'),
        ],

        'mistral' => [
            'driver' => 'mistral',
            'api_key' => env('MISTRAL_API_KEY', ''),
            'model' => env('MISTRAL_MODEL', 'mistral-large-latest'),
        ],

        'openrouter' => [
            'driver' => 'openrouter',
            'api_key' => env('OPENROUTER_API_KEY', ''),
            'model' => env('OPENROUTER_MODEL', 'anthropic/claude-sonnet-4'),
            'site_url' => env('APP_URL', ''),
            'site_name' => env('APP_NAME', 'ZephyrPHP'),
        ],

        'ollama' => [
            'driver' => 'ollama',
            'host' => env('OLLAMA_HOST', 'http://localhost:11434'),
            'model' => env('OLLAMA_MODEL', 'llama3'),
        ],
    ],
];
