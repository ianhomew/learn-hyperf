<?php

declare(strict_types=1);

namespace App\Middleware;

use GuzzleHttp\Psr7\Stream;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FooMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        echo 3;
        $response = $handler->handle($request);

        $body = $response->getBody()->getContents();
        $body .= '__' . __CLASS__;

        echo 6;
        return $response->withBody(new SwooleStream($body));
    }
}