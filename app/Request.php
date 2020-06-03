<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:21
 *
 * PHP version 7.2
 */

namespace Wizmo;

class Request
{
    /**
     * @var array<string, string|bool|int|float|null>
     */
    private array $params;

    /**
     * Request constructor.
     *
     * @param array<string, string|bool|int|float|null> $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string                     $key
     * @param string|bool|int|float|null $default
     *
     * @return string|bool|int|float|null
     */
    public function get(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    /**
     * @param string $key
     */
    public function remove(string $key): void
    {
        unset($this->params[$key]);
    }

    /**
     * @param string                     $key
     * @param string|bool|int|float|null $value
     *
     * @return void
     */
    public function set(string $key, $value): void
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

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->params);
    }
}
