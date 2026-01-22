<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Migrator
{
    public function __construct(private PDO $db)
    {
    }

    public function run(string $migrationsPath): void
    {
        $this->db->exec('CREATE TABLE IF NOT EXISTS migrations (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, batch INT NOT NULL)');

        $applied = $this->db->query('SELECT name FROM migrations')->fetchAll(PDO::FETCH_COLUMN);
        $files = glob(rtrim($migrationsPath, '/') . '/*.php');
        sort($files);

        $batch = (int) $this->db->query('SELECT MAX(batch) FROM migrations')->fetchColumn();
        $batch++;

        foreach ($files as $file) {
            $name = basename($file);
            if (in_array($name, $applied, true)) {
                continue;
            }

            $queries = require $file;
            if (!is_array($queries)) {
                continue;
            }

            foreach ($queries as $query) {
                $this->db->exec($query);
            }

            $statement = $this->db->prepare('INSERT INTO migrations (name, batch) VALUES (:name, :batch)');
            $statement->execute(['name' => $name, 'batch' => $batch]);
        }
    }
}
