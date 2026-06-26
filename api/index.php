<?php

// Kalau tidak ada .env, pakai .env.production (untuk Vercel)
if (!file_exists(__DIR__ . '/../.env') && file_exists(__DIR__ . '/../.env.production')) {
    copy(__DIR__ . '/../.env.production', __DIR__ . '/../.env');
}

// Entry point untuk Vercel serverless
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files langsung
if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    return false;
}

// Forward semua request ke Laravel
require_once __DIR__ . '/../public/index.php';
