<?php

namespace Wizmo;

class Sandbox
{
    /**
     * @param string|null $name
     *
     * @return string
     */
    public function run(string $name = null): string
    {
        return 'Hello ' . ($name ?? 'World');
    }
}
