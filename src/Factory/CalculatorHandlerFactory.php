<?php

namespace SimoBanduraYaroslav\Blogmaster\Factory;


use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;
use SimoBanduraYaroslav\Blogmaster\Infrastructure\SimpleContainer;
use Twig\Environment;

final readonly class CalculatorHandlerFactory
{


    public function __construct(private SimpleContainer $container) {

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke():CalculatorHandler
    {
        $twig = $this->container->get(Environment::class);
        $calc = $this->container->get(Calculator::class);
        return new CalculatorHandler($twig, $calc);
    }
}