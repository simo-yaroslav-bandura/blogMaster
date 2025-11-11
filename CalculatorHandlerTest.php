<?php

namespace SimoBanduraYaroslav\Blogmaster\Handler;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\ServerRequest;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class CalculatorHandlerTest extends TestCase
{
    public function testHandle()
    {
        // Создаем мок калькулятора
        $calculator = $this->createMock(Calculator::class);
        $calculator->expects($this->once())
            ->method('calculate')
            ->with(10.0, 'add', 5.0)
            ->willReturn(15.0);

        // Создаем Twig с простым шаблоном
        $loader = new ArrayLoader([
            'calculator.twig' => 'Result: {{ result }}'
        ]);
        $twig = new Environment($loader);

        // Создаем handler
        $handler = new CalculatorHandler($twig, $calculator);

        // Создаем POST запрос с параметрами
        $request = (new ServerRequest())
            ->withMethod('POST')
            ->withParsedBody([
                'a' => '10',
                'b' => '5',
                'operation' => 'add'
            ]);

        // Выполняем запрос
        $response = $handler->handle($request);

        // Проверяем результат
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Result: 15', (string)$response->getBody());
    }

    public function testHandleWithGetRequest()
    {
        $calculator = $this->createMock(Calculator::class);
        $calculator->expects($this->once())
            ->method('calculate')
            ->with(20.0, 'subtract', 8.0)
            ->willReturn(12.0);

        $loader = new ArrayLoader([
            'calculator.twig' => 'A: {{ a }}, B: {{ b }}, Result: {{ result }}'
        ]);
        $twig = new Environment($loader);

        $handler = new CalculatorHandler($twig, $calculator);

        // GET запрос
        $request = (new ServerRequest())
            ->withMethod('GET')
            ->withQueryParams([
                'a' => '20',
                'b' => '8',
                'operation' => 'subtract'
            ]);

        $response = $handler->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Result: 12', (string)$response->getBody());
    }

    public function testHandleWithoutParameters()
    {
        $calculator = $this->createMock(Calculator::class);
        $calculator->expects($this->never())
            ->method('calculate');

        $loader = new ArrayLoader([
            'calculator.twig' => 'Result: {{ result }}'
        ]);
        $twig = new Environment($loader);

        $handler = new CalculatorHandler($twig, $calculator);

        $request = new ServerRequest();

        $response = $handler->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Result:', (string)$response->getBody());
    }
}
