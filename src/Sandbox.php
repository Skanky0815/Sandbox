<?php

declare(strict_types=1);

namespace App;

class Sandbox
{
    public function run(string $name = null): string
    {
        return 'Hello ' . ($name ?? 'World');
    }
}
