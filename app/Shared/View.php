<?php

declare(strict_types=1);

namespace App\Shared;

final class View
{
    public static function render(string $template, array $data = []): string
    {
        $path = dirname(__DIR__, 2) . '/resources/views/' . $template . '.php';

        if (!file_exists($path)) {
            return 'View not found.';
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $path;

        return ob_get_clean() ?: '';
    }
}
