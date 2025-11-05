<?php

namespace SimoBanduraYaroslav\Blogmaster\Calculator;

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

    private function divide(float $a, float $b): float|string
    {
        if ($b == 0) {
            return "Error: Division by zero";
        }
        return $a / $b;
    }

    public function calculate(float $a, string $operation, float $b): float|string
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
            default:
                $result = "Error";
        }
        return $result;
    }
}

