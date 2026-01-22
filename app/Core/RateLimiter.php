<?php

declare(strict_types=1);

namespace App\Core;

final class RateLimiter
{
    public static function hit(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        $now = time();
        $bucket = Session::get('rate_limiter', []);
        $entry = $bucket[$key] ?? ['attempts' => 0, 'expires_at' => $now + $decaySeconds];

        if ($now > $entry['expires_at']) {
            $entry = ['attempts' => 0, 'expires_at' => $now + $decaySeconds];
        }

        $entry['attempts']++;
        $bucket[$key] = $entry;
        Session::set('rate_limiter', $bucket);

        return $entry['attempts'] <= $maxAttempts;
    }
}
