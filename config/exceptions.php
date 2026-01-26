<?php

/**
 * Exception Handling Configuration
 *
 * Customize error messages shown to users for different exception types.
 * These messages are shown in production mode. In debug mode, the actual
 * exception details are displayed instead.
 *
 * The exception handler automatically extracts field names from database errors
 * and generates dynamic, user-friendly messages.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Database Exception Messages
    |--------------------------------------------------------------------------
    |
    | Generic messages for database errors. Use :field placeholder to include
    | the automatically detected field name in the message.
    |
    | Examples:
    |   'unique' => 'The :field has already been taken.'
    |   Result: "The Email has already been taken." (if email field caused error)
    |
    */
    'database' => [
        // Shown when trying to insert/update a duplicate value in a unique column
        // :field will be replaced with the detected field name (e.g., "Email", "Username")
        'unique' => 'The :field has already been taken.',

        // Shown when a required field is not provided
        'not_null' => 'The :field field is required.',

        // Shown when referencing a record that doesn't exist
        'foreign_key' => 'Invalid :field. The referenced record does not exist.',

        // Shown when database connection fails
        'connection' => 'Unable to connect to the database. Please try again later.',

        // Shown when a required table doesn't exist
        'table_not_found' => 'The requested resource is not available.',

        // Shown for SQL syntax errors (should not happen in production)
        'syntax_error' => 'An error occurred while processing your request.',

        // Shown when database deadlock occurs
        'deadlock' => 'The server is busy. Please try again in a moment.',

        // Shown when lock wait timeout occurs
        'lock_timeout' => 'The operation timed out. Please try again.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Field-Specific Messages
    |--------------------------------------------------------------------------
    |
    | Override messages for specific fields. These take priority over the
    | generic database messages above.
    |
    | Format: 'field_name' => ['error_type' => 'Custom message']
    |
    | Example:
    |   'email' => [
    |       'unique' => 'This email address is already registered.',
    |       'not_null' => 'Please provide your email address.',
    |   ],
    |
    */
    'fields' => [
        // Example: Custom messages for email field
        // 'email' => [
        //     'unique' => 'This email address is already registered. Did you forget your password?',
        //     'not_null' => 'Please provide your email address.',
        // ],

        // Example: Custom messages for username field
        // 'username' => [
        //     'unique' => 'This username is taken. Please choose another one.',
        // ],

        // Example: Custom messages for user_id (foreign key)
        // 'user_id' => [
        //     'foreign_key' => 'The selected user does not exist.',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Exception Messages
    |--------------------------------------------------------------------------
    |
    | Default messages for HTTP status codes. These are used by the
    | HttpException class and the default error pages.
    |
    */
    'http' => [
        400 => 'The request could not be understood by the server.',
        401 => 'Authentication is required to access this resource.',
        403 => 'You do not have permission to access this resource.',
        404 => 'The page you are looking for could not be found.',
        405 => 'The request method is not supported for this resource.',
        419 => 'Your session has expired. Please refresh and try again.',
        422 => 'The submitted data could not be processed.',
        429 => 'You have made too many requests. Please try again later.',
        500 => 'Something went wrong on our end. Please try again later.',
        503 => 'The service is temporarily unavailable. Please try again later.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Don't Report These Exceptions
    |--------------------------------------------------------------------------
    |
    | List exception classes that should not be logged. Useful for exceptions
    | that are expected during normal operation (like validation errors).
    |
    */
    'dont_report' => [
        // ZephyrPHP\Validation\ValidationException::class,
        // ZephyrPHP\Exception\HttpException::class,
    ],
];
