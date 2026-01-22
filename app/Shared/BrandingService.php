<?php

declare(strict_types=1);

namespace App\Shared;

use PDO;

final class BrandingService
{
    private array $keys = [
        'brand_name',
        'brand_tagline',
        'brand_logo_url',
        'brand_favicon_url',
        'brand_primary_color',
        'brand_secondary_color',
        'footer_text',
    ];

    public function getBranding(PDO $db, ?int $organizationId = null): array
    {
        $branding = Config::get('branding');

        if ($organizationId === null) {
            return $branding;
        }

        $placeholders = implode(',', array_fill(0, count($this->keys), '?'));
        $statement = $db->prepare(
            'SELECT setting_key, setting_value FROM settings WHERE organization_id = ? AND setting_key IN (' . $placeholders . ')'
        );
        $statement->execute(array_merge([$organizationId], $this->keys));
        $rows = $statement->fetchAll(PDO::FETCH_KEY_PAIR);

        foreach ($rows as $key => $value) {
            if (isset($branding[$key])) {
                $branding[$key] = $value;
            }
        }

        return $branding;
    }

    public function saveBranding(PDO $db, int $organizationId, array $data): void
    {
        $statement = $db->prepare(
            'INSERT INTO settings (organization_id, setting_key, setting_value) VALUES (:org, :key, :value)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
        );

        foreach ($this->keys as $key) {
            if (!array_key_exists($key, $data)) {
                continue;
            }
            $statement->execute([
                'org' => $organizationId,
                'key' => $key,
                'value' => $data[$key],
            ]);
        }
    }
}
