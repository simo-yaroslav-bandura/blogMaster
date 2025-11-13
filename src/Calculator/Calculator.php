<?php

namespace SimoBanduraYaroslav\Blogmaster\Calculator;

use DivisionByZeroError;
use InvalidArgumentException;

class Calculator
{
    private function add(float $a, float $b): float
    {
        return $a + $b;
    }

    private function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    private function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    private function divide(float $a, float $b): float
    {
        if ($b == 0) {
            throw new DivisionByZeroError("Division by zero is not allowed.");
        }
        return $a / $b;
    }

    public function calculate(float $a, string $operation, float $b): float
    {
        switch ($operation) {
            case 'add':
                $result = $this->add($a, $b);
                break;
            case 'subtract':
                $result = $this->subtract($a, $b);
                break;
            case 'multiply':
                $result = $this->multiply($a, $b);
                break;
            case 'divide':
                $result = $this->divide($a, $b);
                break;
            default;
            throw new InvalidArgumentException("Invalid operation: {$operation}");
        }
        return $result;
    }
}

