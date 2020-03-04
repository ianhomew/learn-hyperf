<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\UserRegistered;
use App\Event\ValidateRegister;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * @Listener
 *
 * 事件監聽器 這裡測試兩個監聽物件
 */
class RegisterLogListener implements ListenerInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function listen(): array
    {
        return [
            UserRegistered::class,
            ValidateRegister::class,
        ];
    }

    /**
     * @param object $event
     */
    public function process(object $event)
    {
        // 事件觸發後該監聽器要執行的程式碼寫在這裡，比如該示例下的傳送使用者註冊成功簡訊等
        if ($event instanceof UserRegistered) {
            echo 'LOG TO UserRegistered' . PHP_EOL;
        } elseif ($event instanceof ValidateRegister) {
            echo 'LOG TO ValidateRegister' . PHP_EOL;
        }
    }
}
