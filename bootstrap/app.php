<?php

/**
 * Application Bootstrap
 *
 * This file is loaded before the application starts. Use it to configure
 * exception handling, register custom services, or perform any setup that
 * needs to happen early in the application lifecycle.
 *
 * This file is optional - you can delete it if you don't need custom configuration.
 */

use ZephyrPHP\Exception\Handler;

/*
|--------------------------------------------------------------------------
| Configure Exception Handler
|--------------------------------------------------------------------------
|
| The exception handler is responsible for catching and displaying errors.
| You can customize how different exceptions are handled here.
|
| There are THREE ways to customize exception messages:
|
| 1. CONFIG FILE (Recommended for most cases)
|    Edit config/exceptions.php to customize messages
|
| 2. PROGRAMMATIC (This file - for dynamic configuration)
|    Use Handler methods to set messages or register handlers
|
| 3. CUSTOM HANDLERS (For complete control)
|    Register a callback to handle specific exception types
|
*/

// Get the exception handler instance
$handler = Handler::getInstance();

/*
|--------------------------------------------------------------------------
| Option 2: Set Custom Messages Programmatically
|--------------------------------------------------------------------------
|
| Use this when you need to set messages dynamically (e.g., based on locale,
| user preferences, or application state).
|
| This MERGES with config/exceptions.php - config file is loaded first,
| then these messages override or add to it.
|
*/

// Example: Override or add field-specific messages
// $handler->setMessages([
//     'fields' => [
//         'email' => [
//             'unique' => 'This email address is already registered. Did you forget your password?',
//             'not_null' => 'Please provide your email address.',
//         ],
//         'username' => [
//             'unique' => 'Sorry, this username is taken. Try adding some numbers!',
//         ],
//         'phone' => [
//             'unique' => 'This phone number is already linked to another account.',
//         ],
//     ],
//     'database' => [
//         'unique' => 'The :field is already in use. Please try a different value.',
//         'foreign_key' => 'Cannot complete this action. The :field references data that no longer exists.',
//     ],
// ]);

/*
|--------------------------------------------------------------------------
| Option 3: Register Custom Exception Handlers
|--------------------------------------------------------------------------
|
| Use this when you need complete control over how an exception is handled.
| Your handler receives the exception and can return a response, redirect,
| or perform any custom logic.
|
| Return a non-null value to stop further handling.
| Return null to continue with default handling.
|
*/

// Example: Custom handler for unique constraint violations
// use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
//
// $handler->registerHandler(
//     UniqueConstraintViolationException::class,
//     function (UniqueConstraintViolationException $e) {
//         // Log to external service
//         // error_log('Duplicate entry attempt: ' . $e->getMessage());
//
//         // Custom redirect with custom message
//         if (!headers_sent() && isset($_SERVER['HTTP_REFERER'])) {
//             $_SESSION['_flash']['error'] = 'This record already exists in our system.';
//             $_SESSION['_flash']['_old_input'] = $_POST ?? [];
//             header('Location: ' . $_SERVER['HTTP_REFERER'], true, 303);
//             return true; // Handled - stop further processing
//         }
//
//         return null; // Let default handler take over
//     }
// );

// Example: Custom handler for all foreign key violations
// use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
//
// $handler->registerHandler(
//     ForeignKeyConstraintViolationException::class,
//     function (ForeignKeyConstraintViolationException $e) {
//         // Determine if it's a delete or insert/update operation
//         $message = str_contains($e->getMessage(), 'delete')
//             ? 'Cannot delete this item because other records depend on it.'
//             : 'The selected reference is invalid.';
//
//         $_SESSION['_flash']['error'] = $message;
//         header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'), true, 303);
//         return true;
//     }
// );

// Example: Custom handler for any Throwable (catch-all)
// $handler->registerHandler(
//     \Throwable::class,
//     function (\Throwable $e) {
//         // Send to error tracking service (Sentry, Bugsnag, etc.)
//         // \Sentry\captureException($e);
//
//         return null; // Continue with default handling
//     }
// );

/*
|--------------------------------------------------------------------------
| Configure What NOT to Report
|--------------------------------------------------------------------------
|
| Some exceptions are expected during normal operation and don't need to be
| logged. Add them here to prevent log file clutter.
|
*/

// $handler->dontReport([
//     \ZephyrPHP\Exception\HttpException::class,
//     \ZephyrPHP\Validation\ValidationException::class,
// ]);

/*
|--------------------------------------------------------------------------
| Set Custom Error Renderer
|--------------------------------------------------------------------------
|
| For complete control over error page rendering, you can set a custom
| renderer function. This is useful for rendering errors using your
| application's view templates.
|
*/

// $handler->setCustomRenderer(function (\Throwable $e) {
//     $statusCode = $e instanceof \ZephyrPHP\Exception\HttpException
//         ? $e->getStatusCode()
//         : 500;
//
//     http_response_code($statusCode);
//
//     // Render using your view system
//     echo view("errors/{$statusCode}", [
//         'exception' => $e,
//         'message' => $e->getMessage(),
//     ])->getContent();
// });
