<?php


namespace App\Event;

/**
 * 一個普通的類別
 *
 * Class UserRegistered
 * @package App\Event
 */
class UserRegistered
{

    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}