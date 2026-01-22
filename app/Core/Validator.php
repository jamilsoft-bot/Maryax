<?php

declare(strict_types=1);

namespace App\Core;

final class Validator
{
    private array $errors = [];

    public function required(string $field, string $value, string $message = ''): void
    {
        if ($value === '') {
            $this->errors[$field] = $message ?: 'This field is required.';
        }
    }

    public function email(string $field, string $value, string $message = ''): void
    {
        if ($value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $message ?: 'Invalid email address.';
        }
    }

    public function minLength(string $field, string $value, int $length, string $message = ''): void
    {
        if (mb_strlen($value) < $length) {
            $this->errors[$field] = $message ?: sprintf('Minimum length is %d.', $length);
        }
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function passes(): bool
    {
        return $this->errors === [];
    }
}
