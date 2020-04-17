<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 16.04.20
 * Time: 21:28
 *
 * PHP version 7.2
 */

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
