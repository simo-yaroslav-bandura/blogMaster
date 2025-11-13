<?php

namespace SimoBanduraYaroslav\Blogmaster\Application;

use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use SimoBanduraYaroslav\Blogmaster\Factory\CalculatorHandlerFactory;
use SimoBanduraYaroslav\Blogmaster\Factory\TwigFactory;
use SimoBanduraYaroslav\Blogmaster\Infrastructure\ErrorHandleMiddleware;
use SimoBanduraYaroslav\Blogmaster\Infrastructure\NotFoundMiddleware;
use SimoBanduraYaroslav\Blogmaster\Infrastructure\SimpleContainer;
use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Middlewares\Utils\Dispatcher;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;
use Twig\Environment;
final class Application
{
    public static function run(): void{
        $request  = ServerRequestFactory::fromGlobals();
        $router = simpleDispatcher(function(RouteCollector $r) {
            $r->addRoute(['GET','POST'], '/calculator', CalculatorHandler::class);
        });

        $container = new SimpleContainer(
            [
                CalculatorHandler::class => CalculatorHandlerFactory::class,
                Environment::class => TwigFactory::class,
                Calculator::class => Calculator::class,
            ]
        );

        $middlewareQueue = [
            new ErrorHandleMiddleware(true),
            new NotFoundMiddleware(),
            new FastRoute( $router),
            new RequestHandler($container),
        ];

        $response = (new Dispatcher($middlewareQueue))->dispatch($request);

        (new SapiEmitter())->emit($response);
    }

}