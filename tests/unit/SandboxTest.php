<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Wizmo\Sandbox;

class SandboxTest extends TestCase
{
    /** @test */
    public function runShouldReturnHelloWorldSuccessfully(): void
    {
        $sandbox = new Sandbox();

        $result = $sandbox->run();

        $this->assertEquals('Hello World', $result);
    }

    /** @test */
    public function runShouldReturnHelloNameSuccessfully(): void
    {
        $sandbox = new Sandbox();

        $result = $sandbox->run('Name');

        $this->assertEquals('Hello Name', $result);
    }
}
