<?php

declare(strict_types=1);

use function App\Shared\env;

return [
    'name' => env('APP_NAME', 'Maryax'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', 'false') === 'true',
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'session_name' => env('APP_SESSION', 'maryax_session'),
];
