<?php


namespace App\Services;


use App\Event\RegisterLog;
use App\Event\UserRegistered;
use App\Event\ValidateRegister;
use Hyperf\Di\Annotation\Inject;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * 一個普通的類別 處理用戶註冊的邏輯
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @Inject()
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function register()
    {
        /*
         * 目前這個是單一註冊 實際上如果是大量的寄信或通知 應該丟到隊列裡面去 才不會影響效能
         *
         * 感覺上這個事件機制 是能夠很漂亮的把與業務邏輯不相關的程式碼分離
         * 但是以 RegisterLog 為例 我把log寫在RegisterLog內也可以做到分離的目的
         */



        $userId = rand(0, 9999);

        // 记录 Log
        $this->eventDispatcher->dispatch(new RegisterLog($userId));

        // 註冊前檢查
        /** @var ValidateRegister $validateResult */
        $validateResult = $this->eventDispatcher->dispatch(new ValidateRegister($userId));

        // 註冊過程的業務邏輯
        if ($validateResult->shouldRegister) {
            echo $userId . ' 注册成功' . PHP_EOL;
        } else {
            echo $userId . ' 注册失败' . PHP_EOL;
        }

        // 註冊成功後的行為
        $this->eventDispatcher->dispatch(new UserRegistered($userId));

        return $userId;
    }
}