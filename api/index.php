<?php

// Vercel filesystem read-only — copy .env.production ke /tmp/ dulu
$envDest = '/tmp/.env';
$envSrc  = __DIR__ . '/../.env.production';

if (!file_exists($envDest) && file_exists($envSrc)) {
    copy($envSrc, $envDest);
}

// Override APP_BASE_PATH agar Laravel baca .env dari /tmp/
$_ENV['APP_BASE_PATH'] = dirname(__DIR__);

// Set env path ke /tmp/
putenv('APP_ENV=production');

// Load .env manual sebelum Laravel boot
if (file_exists($envDest)) {
    $lines = file($envDest, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $val] = explode('=', $line, 2);
        $key = trim($key);
        $val = trim($val, " \t\n\r\0\x0B\"'");
        if (!array_key_exists($key, $_ENV)) {
            putenv("$key=$val");
            $_ENV[$key] = $val;
            $_SERVER[$key] = $val;
        }
    }
}

// Entry point untuk Vercel serverless
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files langsung
if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    return false;
}

// Forward semua request ke Laravel
require_once __DIR__ . '/../public/index.php';
