<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Force HTTPS for Vercel serverless (proxy terminates SSL)
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}
// Also force if running on Vercel (always HTTPS)
if (isset($_SERVER['VERCEL']) || isset($_SERVER['HTTP_X_VERCEL_ID']) || (isset($_SERVER['SERVER_NAME']) && str_contains($_SERVER['SERVER_NAME'], 'vercel.app'))) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "Fatal Boot Error: " . $e->getMessage() . "\n\n";
    echo "Exception Class: " . get_class($e) . "\n\n";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "\n\n";
    echo "Stack trace:\n" . $e->getTraceAsString();
    exit(1);
}
