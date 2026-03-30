<?php

/**
 * Exception Configuration
 *
 * Custom error messages for database exceptions and HTTP errors.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Database Exception Messages
    |--------------------------------------------------------------------------
    */
    'database' => [
        'unique' => 'A record with this value already exists.',
        'not_null' => 'This field is required.',
        'foreign_key' => 'This record is referenced by other data and cannot be removed.',
        'connection' => 'Unable to connect to the database. Please try again later.',
        'table_not_found' => 'The requested resource could not be found.',
        'syntax_error' => 'An internal error occurred. Please contact support.',
        'deadlock' => 'A conflict occurred. Please try again.',
        'lock_timeout' => 'The request timed out. Please try again.',
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Exception Messages
    |--------------------------------------------------------------------------
    */
    'http' => [
        400 => 'Bad request.',
        401 => 'You must be logged in to access this page.',
        403 => 'You do not have permission to access this page.',
        404 => 'The page you are looking for could not be found.',
        405 => 'This action is not allowed.',
        419 => 'Your session has expired. Please refresh and try again.',
        422 => 'The submitted data is invalid.',
        429 => 'Too many requests. Please wait a moment and try again.',
        500 => 'An internal server error occurred.',
        503 => 'The application is currently undergoing maintenance.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exceptions Not to Report
    |--------------------------------------------------------------------------
    */
    'dont_report' => [],
];
