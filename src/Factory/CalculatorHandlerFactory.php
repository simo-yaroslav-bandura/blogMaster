<?php

namespace SimoBanduraYaroslav\Blogmaster\Factory;


use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class CalculatorHandlerFactory
{
    public function __invoke():CalculatorHandler
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Calculator/Templates');
        $twig = new Environment($loader,
            [
                'cache'       => false,
                'auto_reload' => true,
                'autoescape'  => 'html',
            ]
        );
        $calc = new Calculator();
        return new CalculatorHandler($twig, $calc);
    }
}