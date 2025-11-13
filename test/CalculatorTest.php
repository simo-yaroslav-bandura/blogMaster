<?php

namespace SimoBanduraYaroslav\Blogmaster\Handler;

use DivisionByZeroError;
use PHPUnit\Framework\Attributes\DataProvider;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    #[DataProvider('cases')]
    public function testCalculateBasicOperations(string $op, float $a, float $b, float $expected): void
    {
        $calc = new Calculator();
        $actual = $calc->calculate($a, $op, $b);
        $this->assertSame($expected, $actual);    }

    public static function cases(): array
    {
        return [
            'add'      => ['add',      10.0, 5.0, 15.0],
            'subtract' => ['subtract', 20.0, 8.0, 12.0],
            'multiply' => ['multiply', 10.0, 10.0, 100.0],
            'divide'   => ['divide',   10.0, 5.0, 2.0],
        ];
    }

    public function testDivideByZero()
    {
        $calc = new Calculator();
        $this->expectException(DivisionByZeroError::class);
        $calc->calculate(10.0, 'divide', 0.0);

    }
}
