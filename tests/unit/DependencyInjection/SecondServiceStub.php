<?php

declare(strict_types=1);

namespace Tests\Unit\DependencyInjection;

class SecondServiceStub
{
    public function __construct(public ServiceStub $service) {}
}