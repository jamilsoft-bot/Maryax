<?php

declare(strict_types=1);

namespace App\Shared;

use DateTimeImmutable;

function env(string $key, string $default = ''): string
{
    $value = getenv($key);

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

function now(): DateTimeImmutable
{
    return new DateTimeImmutable('now');
}
