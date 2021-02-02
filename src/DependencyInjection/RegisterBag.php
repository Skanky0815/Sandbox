<?php declare(strict_types=1);


namespace App\DependencyInjection;


use ReflectionClass;

class RegisterBag extends Bag implements Register
{
    public function __construct(
        private CreateNewInstance $createNewInstance
    ) { }

    public function get(ReflectionClass $reflectionClass): object
    {
        $instance = $this->getInstanceFromBag($reflectionClass);
        if (is_object($instance)) {
            return $instance;
        }
        return $this->createNewInstance->instantiate($reflectionClass);
    }

    public function bind(string $id, object|callable $binding): void
    {
        $this->bag[$id] = $binding;
    }

    private function getInstanceFromBag(ReflectionClass $reflectionClass): object|null
    {
        $instance = $this->bag[$reflectionClass->getName()] ?? null;
        if (is_callable($instance)) {
            return $instance();
        }
        return $instance;
    }
}