<?php


namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Context;

/**
 *
 * 1. access update() foo=2  return 2
 * 3. access get() return foo is null
 * 每次的請求都是獨立的 上一次的請求不影響這次的請求
 * http本來就是無狀態 good
 *
 * @AutoController()
 *
 * Class TestRequestController
 * @package App\Controller
 */
class TestRequestController
{

    public function get()
    {
        return Context::get('foo', 'foo is null');
    }

    public function update(RequestInterface $request)
    {
        $foo = $request->input('foo');
        Context::set('foo', $foo);

        return Context::get('foo');
    }
}