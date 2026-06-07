<?php

// Force HTTPS detection for Vercel proxy
$_SERVER['HTTPS'] = 'on';
$_SERVER['SERVER_PORT'] = 443;
$_SERVER['REQUEST_SCHEME'] = 'https';

// Force environment variables since vercel.json env{} block does NOT work
// These override the .env file values for the Vercel deployment
putenv('APP_ENV=production');
putenv('APP_DEBUG=true');
putenv('APP_URL=https://e-surat-dpmptsp-rbru.vercel.app');
putenv('ASSET_URL=https://e-surat-dpmptsp-rbru.vercel.app');
putenv('LOG_CHANNEL=stderr');
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('CACHE_STORE=array');
putenv('SESSION_DRIVER=cookie');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');

// Also set in $_ENV and $_SERVER for Laravel's env() helper
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_URL'] = 'https://e-surat-dpmptsp-rbru.vercel.app';
$_ENV['ASSET_URL'] = 'https://e-surat-dpmptsp-rbru.vercel.app';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';

$_SERVER['APP_ENV'] = 'production';
$_SERVER['APP_URL'] = 'https://e-surat-dpmptsp-rbru.vercel.app';
$_SERVER['ASSET_URL'] = 'https://e-surat-dpmptsp-rbru.vercel.app';

require __DIR__ . '/../public/index.php';
