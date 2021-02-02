<?php declare(strict_types=1);


namespace App\DependencyInjection;


use ReflectionClass;

class SingletonBag extends Bag
{
    public function __construct(
        private RegisterBag $registerBag
    ) { }

    public function get(ReflectionClass $reflectionClass): object
    {
        if (array_key_exists($reflectionClass->getName(), $this->bag)) {
            return $this->bag[$reflectionClass->getName()];
        }
        return $this->bag[$reflectionClass->getName()] = $this->registerBag->get($reflectionClass);
    }
}