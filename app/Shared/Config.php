<?php

declare(strict_types=1);

namespace App\Shared;

final class Config
{
    private static array $cache = [];

    public static function get(string $file): array
    {
        if (!isset(self::$cache[$file])) {
            $path = dirname(__DIR__, 2) . '/config/' . $file . '.php';
            self::$cache[$file] = file_exists($path) ? require $path : [];
        }

        return self::$cache[$file];
    }
}
