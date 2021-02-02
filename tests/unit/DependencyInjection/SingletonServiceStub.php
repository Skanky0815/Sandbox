<?php

declare(strict_types=1);

namespace Tests\Unit\DependencyInjection;

use App\DependencyInjection\Singleton;

class SingletonServiceStub implements Singleton
{
    public static int $count = 0;

    public function __construct()
    {
        self::$count++;
    }
}