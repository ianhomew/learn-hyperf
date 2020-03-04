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
 * 事件監聽器 在這裡負責監聽使用者註冊前的驗證
 */
class ValidateRegisterListener implements ListenerInterface
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
            ValidateRegister::class,
        ];
    }

    /**
     * @param object $event
     */
    public function process(object $event)
    {
        // 事件觸發後該監聽器要執行的程式碼寫在這裡，比如該示例下的傳送使用者註冊成功簡訊等

        /**
         * @var ValidateRegister $event
         */
        $event->shouldRegister = (bool) rand(0,5);
        if ($event->shouldRegister) {
            echo $event->userId . '通過註冊前檢查' . PHP_EOL;
        } else {
            echo $event->userId .'沒有通過註冊前檢查' . PHP_EOL;
        }

    }
}
