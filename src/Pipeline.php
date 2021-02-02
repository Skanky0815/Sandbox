<?php

declare(strict_types=1);

namespace App;

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

    public function process(mixed $value): mixed
    {
        foreach ($this->layers as $layer) {
            /** @var mixed $value */
            $value = $layer($value);
        }
        return $value;
    }
}
