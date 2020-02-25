<?php


namespace App\Controller;

use App\Middleware\BarMiddleware;
use App\Middleware\BazMiddleware;
use App\Middleware\FooMiddleware;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;

/**
 * @AutoController()
 *
 * @Middlewares(
 *     @Middleware(BarMiddleware::class),
 *     @Middleware(BazMiddleware::class),
 *     @Middleware(FooMiddleware::class)
 * )
 *
 * Class MiddlewareController
 * @package App\Controller
 */
class MiddlewareController
{


    public function index()
    {
        return 'index';
    }
}