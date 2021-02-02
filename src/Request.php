<?php

declare(strict_types=1);

namespace App;

class Request
{
    /**
     * Request constructor.
     *
     * @param array<string, string|bool|int|float|null> $params
     */
    public function __construct(private array $params)
    {

    }

    public function get(string $key, float|bool|int|string $default = null): float|bool|int|string|null
    {
        return $this->params[$key] ?? $default;
    }

    public function remove(string $key): void
    {
        unset($this->params[$key]);
    }

    public function set(string $key, float|bool|int|string|null $value): void
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array<string, string|bool|int|float|null>
     */
    public function getAll(): array
    {
        return $this->params;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->params);
    }
}
