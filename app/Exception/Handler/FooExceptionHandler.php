<?php


namespace App\Exception\Handler;


use App\Exception\FooException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class FooExceptionHandler extends ExceptionHandler
{

    /**
     * @inheritDoc
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // TODO: Implement handle() method.
        $this->stopPropagation();
        return $response->withStatus(500)->withBody(new SwooleStream('This is FooExceptionHandler'));
    }

    /**
     * @inheritDoc
     */
    public function isValid(Throwable $throwable): bool
    {
        // TODO: Implement isValid() method.
        return $throwable instanceof FooException;
    }
}