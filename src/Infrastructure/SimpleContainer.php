<?php

namespace SimoBanduraYaroslav\Blogmaster\Infrastructure;

use RuntimeException;
use SimoBanduraYaroslav\Blogmaster\Factory\CalculatorHandlerFactory;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;

final class SimpleContainer implements \Psr\Container\ContainerInterface
{

    public function get(string $id)
    {
        if ($id === CalculatorHandler::class) {
            $factory = new CalculatorHandlerFactory();
            return $factory();
        }

        if (class_exists($id)) {
            return new $id();
        }

        throw new RuntimeException("Service not found: {$id}");
    }

    public function has(string $id) : bool
    {
        if ($id === CalculatorHandler::class) {
            return true;
        }
        return class_exists($id);
    }
}