<?php declare(strict_types=1);

namespace App\DependencyInjection;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use Throwable;

class ServiceContainer implements ContainerInterface, Register
{
    private SingletonBag $singletonBag;

    private RegisterBag $registerBag;

    public function __construct(Provider ...$serviceProviders)
    {
        $this->registerBag = new RegisterBag(new CreateNewInstance($this));
        $this->singletonBag = new SingletonBag($this->registerBag);

        foreach ($serviceProviders as $serviceProvider) {
            $serviceProvider->handle($this);
        }
    }

    public function get($id): object
    {
        try {
           return $this->getInstance($id);
        } catch (Throwable $exception) {
            throw new ContainerException($exception->getMessage(), throable: $exception);
        }
    }

    public function has($id): bool
    {
        return class_exists($id);
    }

    public function bind(string $id, callable|object $binding): void
    {
        $this->registerBag->bind($id, $binding);
    }

    private function getInstance(string $id): object
    {
        $reflectionClass = new ReflectionClass($id);
        if ($reflectionClass->implementsInterface(Singleton::class)) {
            return $this->singletonBag->get($reflectionClass);
        }
        return $this->registerBag->get($reflectionClass);
    }
}
