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
 * @property int $foo
 *
 * Class TestRequestController
 * @package App\Controller
 */
class TestRequestController
{

    public function get()
    {
        return $this->foo;
    }

    public function update(RequestInterface $request)
    {
        $foo = $request->input('foo');
        $this->foo = $foo;

        return $this->foo;
    }

    public function __get($name)
    {
        return Context::get(__CLASS__ . ':' . $name, null);
    }

    public function __set($name, $value)
    {
        Context::set(__CLASS__ . ':' . $name, $value);
    }


}