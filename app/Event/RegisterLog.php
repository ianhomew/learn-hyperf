<?php


namespace App\Event;


class RegisterLog
{
    public $shouldRegister = true;
    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

}