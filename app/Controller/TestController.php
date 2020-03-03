<?php


namespace App\Controller;

use App\Exception\FooException;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 *
 * Class TestController
 * @package App\Controller
 */
class TestController extends AbstractController
{
    public function co()
    {
        co(function () {
            while (true) {
                echo '===';
                sleep(1);
            }
        });

        return 1;
    }

    public function exception()
    {
        throw new FooException('Foo Exception');
    }
}