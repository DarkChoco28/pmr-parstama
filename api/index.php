<?php

$appRoot = dirname(__DIR__);

// Load .env.production manual ke $_ENV dan putenv
$envFile = $appRoot . '/.env.production';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $val] = explode('=', $line, 2);
        $key = trim($key);
        $val = trim($val, " \t\n\r\0\x0B\"'");
        if (!isset($_ENV[$key])) {
            putenv("$key=$val");
            $_ENV[$key]    = $val;
            $_SERVER[$key] = $val;
        }
    }
}

// Forward ke Laravel
require_once $appRoot . '/public/index.php';
