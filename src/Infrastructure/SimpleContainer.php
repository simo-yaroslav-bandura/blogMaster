<?php

namespace SimoBanduraYaroslav\Blogmaster\Infrastructure;

use Psr\Container\ContainerInterface;
use RuntimeException;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use SimoBanduraYaroslav\Blogmaster\Handler\CalculatorHandler;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class SimpleContainer implements ContainerInterface
{

    public function __construct(private array $config = [])
    {

    }

    public function get(string $id)
    {
//        if ($id === CalculatorHandler::class) {
//            return new CalculatorHandler(
//                $this->get(Environment::class),
//                $this->get(Calculator::class)
//            );
//        }
//
//        if ($id === Environment::class) {
//            $loader = new FilesystemLoader(__DIR__ . '/../Calculator/Templates');
//            return new Environment($loader, [
//                'cache'       => false,
//                'auto_reload' => true,
//                'autoescape'  => 'html',
//            ]);
//        }
//
//        if ($id === Calculator::class) {
//            return new Calculator();
//        }
//
//        if (class_exists($id)) {
//            return new $id();
//        }
        if ($this->has($id)) {
            $factoryClassName = $this->config[$id];
            $factoryOrObject = new $factoryClassName($this);
            if ($isFactory = is_callable($factoryOrObject)) {
                return $factoryOrObject();
            }
            return $factoryOrObject;
        }

        throw new RuntimeException("Service not found: {$id}");
    }

    public function has(string $id) : bool
    {
        if (isset($this->config[$id])) {
            return true;
        }
        return false;
    }
}