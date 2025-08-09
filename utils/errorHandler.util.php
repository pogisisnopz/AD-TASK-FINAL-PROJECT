<?php

// Set error reporting level
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Custom error handler function
function customErrorHandler($severity, $message, $file, $line)
{
    // Error code for ignoring certain errors
    if (error_reporting() === 0) {
        return;
    }

    // Format the error message
    $errorMessage = "Error: [$severity] $message in $file on line $line\n";

    // Log to a file (log-errors.log) and also display it (for development)
    error_log($errorMessage, 3, __DIR__ . '/log-errors.log');
    
    // Display error in a nice format (for dev purposes)
    if ($severity === E_WARNING || $severity === E_NOTICE) {
        echo "<div style='color: orange; background-color: #f8d7da; padding: 10px; border-radius: 5px;'>$errorMessage</div>";
    } else {
        echo "<div style='color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;'>$errorMessage</div>";
    }
}

// Custom exception handler function
function customExceptionHandler($exception)
{
    $errorMessage = "Uncaught Exception: [" . $exception->getCode() . "] " . $exception->getMessage() . "\n";
    error_log($errorMessage, 3, __DIR__ . '/log-errors.log');
    echo "<div style='color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;'>$errorMessage</div>";
}

// Set the custom error and exception handlers
set_error_handler('customErrorHandler');
set_exception_handler('customExceptionHandler');
