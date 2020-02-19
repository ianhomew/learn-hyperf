<?php


namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * 不使用協程上下文context 會有問題
 * 1. access get()  return 1
 * 2. access update() foo=2  return 2
 * 3. repeat access get() return 2
 * 每次的請求都是獨立的 結果顯示必非獨立 會產生問題
 * 例如一個玩家Ａ目前擁有的金額是100元
 * 充值200元 現在是300元
 * 輪到玩家Ｂ 會直接抓出300元
 *
 * 主要原因是因為 $foo 是整個進程共用的 因為 TestRequestController 是一個單例
 *
 * @AutoController()
 *
 * Class TestRequestController
 * @package App\Controller
 */
class TestRequestController
{

    private $foo = 1;

    public function get()
    {
        return $this->foo;
    }

    public function update(RequestInterface $request)
    {
        $this->foo = $request->input('foo');

        return $this->foo;
    }
}