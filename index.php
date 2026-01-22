<?php

declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (str_starts_with($path, '/installer')) {
    require __DIR__ . '/public/installer/index.php';
    return;
}

require __DIR__ . '/public/index.php';
