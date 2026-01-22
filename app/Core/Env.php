<?php

declare(strict_types=1);

namespace App\Core;

use Dotenv\Dotenv;

final class Env
{
    public static function load(string $basePath): void
    {
        if (!file_exists($basePath . '/.env')) {
            return;
        }

        $dotenv = Dotenv::createImmutable($basePath);
        $dotenv->safeLoad();
    }
}
