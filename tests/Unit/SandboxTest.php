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

use Wizmo\Sandbox;

class SandboxTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function runShouldEchoHelloWorldSuccessfully(): void
    {
        $sandbox = new Sandbox();

        $result = $sandbox->run();

        $this->assertEquals('Hello World', $result);
    }
}
