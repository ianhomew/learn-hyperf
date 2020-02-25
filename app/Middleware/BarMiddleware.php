<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BarMiddleware implements MiddlewareInterface
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
        // 这样会收不到 主要原因是 在控制器内部取得的 $request 是来自协程上下文
        $request->withAttribute('foo', 'foo_test');

        // 这样可以收到 因为使用 Context::override 了 $request 并且最后让闭包返回 $request 对象
        $request = Context::override(ServerRequestInterface::class, function () use ($request) {
            return $request->withAttribute('foo', 'NEW_FOO');
        });



        echo 1;
        $response = $handler->handle($request);
        echo 4;
        return $response;
    }
}