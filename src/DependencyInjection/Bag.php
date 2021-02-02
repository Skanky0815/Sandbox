<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use ReflectionClass;

abstract class Bag
{
    protected array $bag = [];

    abstract public function get(ReflectionClass $reflectionClass): object;
}