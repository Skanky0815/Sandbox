<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Sandbox;
use PHPUnit\Framework\TestCase;

class SandboxTest extends TestCase
{
    /** @test */
    public function runShouldWithoutAParameterAndReturnTheDefaultSuccessfully(): void
    {
        $sandbox = new Sandbox();

        $result = $sandbox->run();

        $this->assertEquals('Hello World', $result);
    }

    /**
     * @test
     * @dataProvider nameProvider
     *
     * @param string $name
     * @param string $expected
     *
     * @return void
     */
    public function runShouldWithAParameterReturnAModifiedStringSuccessfully(string $name, string $expected): void
    {
        $sandbox = new Sandbox();

        $result = $sandbox->run($name);

        $this->assertSame($expected, $result);
    }

    /**
     * @return array<string, array<string>>
     */
    public function nameProvider(): array
    {
        return [
            'Hello Gerrick' => ['Gerrick', 'Hello Gerrick'],
            'Hello Thomas' => ['Thomas', 'Hello Thomas'],
            'Hello Rico' => ['Rico', 'Hello Rico'],
            'Hello Basti' => ['Basti', 'Hello Basti'],
        ];
    }
}
