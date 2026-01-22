<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Seeder
{
    public function __construct(private PDO $db)
    {
    }

    public function run(string $seederPath): void
    {
        $files = glob(rtrim($seederPath, '/') . '/*.php');
        sort($files);

        foreach ($files as $file) {
            $seeder = require $file;
            if (is_callable($seeder)) {
                $seeder($this->db);
            }
        }
    }
}
