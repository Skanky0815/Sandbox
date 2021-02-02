<?php declare(strict_types=1);


namespace App\DependencyInjection;


use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionMethod;

class CreateNewInstance
{
    public function __construct(
        private ContainerInterface $container
    ) { }

    public function instantiate(ReflectionClass $reflectionClass): object
    {
        if (($constructor = $reflectionClass->getConstructor()) instanceof ReflectionMethod) {
            $params = $this->setupConstructorParams($constructor);
            return $reflectionClass->newInstanceArgs($params);
        } else {
            return $reflectionClass->newInstance();
        }
    }

    private function setupConstructorParams(ReflectionMethod $constructor = null): array
    {
        $params = [];
        foreach ($constructor->getParameters() as $parameter) {
            $params[] = $this->container->get($parameter->getType()->getName());
        }
        return $params;
    }
}