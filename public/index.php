<?php
declare(strict_types=1);

use Laminas\Diactoros\Response\HtmlResponse;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use SimoBanduraYaroslav\Blogmaster\Factory\CalculatorHandlerFactory;
use SimoBanduraYaroslav\Blogmaster\Factory\TwigFactory;
use SimoBanduraYaroslav\Blogmaster\Infrastructure\SimpleContainer;
use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Middlewares\Utils\Dispatcher;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;
use Twig\Environment;

require_once __DIR__ . '/../vendor/autoload.php';

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
    new FastRoute( $router),
    new RequestHandler($container),
];
$response = (new Dispatcher($middlewareQueue))->dispatch($request);

if ($response->getStatusCode() === 404) {
    $response = new HtmlResponse('<h1>404-Not found</h1>', 404);
}

$emitter = new SapiEmitter();
$emitter->emit($response);