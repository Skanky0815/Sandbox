<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\FizzBuzz;
use PHPUnit\Framework\TestCase;

/*
 * Schreibe ein Programm das alle Zahlen von 1 bis 100 ausgibt.
 * Wenn die Zahl allerdings ein Vielfaches von 3 ist, soll statt der Zahl das Wort "Fizz" ausgegeben werden.
 * Wenn die Zahl ein Vielfaches von 5 ist, soll statt der Zahl das Wort "Buzz" ausgegeben werden.
 * Ist die Zahl sowohl ein Vielfaches von 3 als auch von 5, soll statt der Zahl das Wort "FizzBuzz" ausgegeben werden.
 */

class FizzBuzzTest extends TestCase
{
    /** @test */
    public function isAssertTrueIsTrueTheTestShouldBeSuccessfully(): void
    {
        $this->assertTrue(true);
    }
}
