<?php
header('Content-Type: application/json');
echo json_encode([
    'HTTPS' => $_SERVER['HTTPS'] ?? 'NOT SET',
    'SERVER_PORT' => $_SERVER['SERVER_PORT'] ?? 'NOT SET',
    'HTTP_X_FORWARDED_PROTO' => $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'NOT SET',
    'HTTP_X_VERCEL_ID' => $_SERVER['HTTP_X_VERCEL_ID'] ?? 'NOT SET',
    'VERCEL' => $_SERVER['VERCEL'] ?? 'NOT SET',
    'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'NOT SET',
    'REQUEST_SCHEME' => $_SERVER['REQUEST_SCHEME'] ?? 'NOT SET',
    'APP_URL_ENV' => getenv('APP_URL') ?: 'NOT SET',
    'APP_ENV' => getenv('APP_ENV') ?: 'NOT SET',
], JSON_PRETTY_PRINT);
