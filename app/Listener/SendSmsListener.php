<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\UserRegistered;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * @Listener
 *
 * 事件監聽器 在這裡負責監聽使用者註冊後
 */
class SendSmsListener implements ListenerInterface
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
        ];
    }

    /**
     * @param object $event
     */
    public function process(object $event)
    {
        // 事件觸發後該監聽器要執行的程式碼寫在這裡，比如該示例下的傳送使用者註冊成功簡訊等

        /**
         * @var UserRegistered $event
         */
        echo '發送簡訊給 ' . $event->userId . PHP_EOL;
    }
}
