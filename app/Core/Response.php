<?php

declare(strict_types=1);

namespace App\Core;

final class Response
{
    public function __construct(private string $content, private int $status = 200, private array $headers = [])
    {
    }

    public static function html(string $content, int $status = 200, array $headers = []): self
    {
        return new self($content, $status, $headers + ['Content-Type' => 'text/html; charset=utf-8']);
    }

    public static function redirect(string $location): self
    {
        return new self('', 302, ['Location' => $location]);
    }

    public static function notFound(): self
    {
        return new self('Not Found', 404, ['Content-Type' => 'text/plain; charset=utf-8']);
    }

    public function send(): void
    {
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value);
        }
        echo $this->content;
    }
}
