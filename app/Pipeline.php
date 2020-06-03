<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 30.04.20
 * Time: 23:55
 *
 * PHP version 7.2
 */

namespace Wizmo;

class Pipeline
{
    /**
     * @var array<int, callable>
     */
    private array $layers;

    /**
     * Pipeline constructor.
     *
     * @param array<int, callable> $layers
     */
    public function __construct(callable ...$layers)
    {
        $this->layers = $layers;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function process($value)
    {
        foreach ($this->layers as $layer) {
            /** @var mixed $value */
            $value = $layer($value);
        }
        return $value;
    }
}
