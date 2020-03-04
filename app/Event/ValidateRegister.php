<?php


namespace App\Event;


class ValidateRegister
{
    public $shouldRegister = true;
    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}