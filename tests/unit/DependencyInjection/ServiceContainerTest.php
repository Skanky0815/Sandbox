<?php

declare(strict_types=1);

namespace Tests\Unit\DependencyInjection;

use App\DependencyInjection\Provider;
use App\DependencyInjection\ServiceContainer;
use PHPUnit\Framework\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testGetShouldReturnARequestedInstanceOfAClass(): void
    {
        $this->assertInstanceOf(ServiceStub::class, (new ServiceContainer())->get(ServiceStub::class));
    }

    public function testConstructorShouldCallBindFromTheGivenProvider(): void
    {
        $providerStub = $this->createMock(Provider::class);
        $providerStub->expects($this->once())->method('handle');

        (new ServiceContainer($providerStub));
    }

    public function testGetShouldInjectRequiredServiceInTheConstructor(): void
    {
        $service = (new ServiceContainer())->get(SecondServiceStub::class);

        $this->assertInstanceOf(ServiceStub::class, $service->service);
    }

    public function testGetShouldInstantiateSingletonsOnlyOnce(): void
    {
        $container = new ServiceContainer();
        $container->get(SingletonServiceStub::class);
        $service = $container->get(SingletonServiceStub::class);
        $this->assertSame(1, $service::$count);
    }
}