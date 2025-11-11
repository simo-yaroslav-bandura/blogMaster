<?php

namespace SimoBanduraYaroslav\Blogmaster\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;
use Twig\Environment;

final class CalculatorHandler implements RequestHandlerInterface
{
    public function __construct(
        private Environment $twig,
        private Calculator $calc)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $a = null;
        $b = null;
        $operation = 'add';
        $result = '';

        $params = strtoupper($request->getMethod()) === 'POST'
            ? ($request->getParsedBody() ?? [])
            : ($request->getQueryParams() ?? []);

        if (isset($params['a'])) $a = (float)$params['a'];
        if (isset($params['b'])) $b = (float)$params['b'];
        if (!empty($params['operation'])) $operation = (string)$params['operation'];

        if ($a !== null && $b !== null) {
            $result = $this->calc->calculate($a, $operation, $b);
        }

        $html = $this->twig->render('calculator.twig', [
            'a'         => $a,
            'b'         => $b,
            'operation' => $operation,
            'result'    => $result,
        ]);

        return new HtmlResponse($html);
    }
}