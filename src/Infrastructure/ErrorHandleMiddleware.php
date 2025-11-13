<?php

namespace SimoBanduraYaroslav\Blogmaster\Infrastructure;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

final class ErrorHandleMiddleware implements MiddlewareInterface
{
    public function __construct(private bool $debag = false)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            if ($this->debag) {
                $body = sprintf(
                    '<h1>Application error</h1><pre>%s</pre>',
                    htmlspecialchars((string)$e, ENT_QUOTES, 'UTF-8')
                );
            } else {
                $body = '<h1>Internal Server Error</h1>';
            }
        }
        return new HtmlResponse($body, 500);
    }
}