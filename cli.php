<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Core\Env;
use App\Core\Migrator;
use App\Core\Seeder;
use App\Shared\Config;

Env::load(__DIR__);

$command = $argv[1] ?? '';

if ($command === 'migrate') {
    $pdo = App\Core\Database::connect(Config::get('database'));
    (new Migrator($pdo))->run(__DIR__ . '/database/migrations');
    echo "Migrations complete.\n";
    exit(0);
}

if ($command === 'seed') {
    $pdo = App\Core\Database::connect(Config::get('database'));
    (new Seeder($pdo))->run(__DIR__ . '/database/seeders');
    echo "Seeders complete.\n";
    exit(0);
}

echo "Usage: php cli.php migrate|seed\n";
