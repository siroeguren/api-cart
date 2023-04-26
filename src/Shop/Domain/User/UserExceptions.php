<?php

namespace App\Shop\Domain\User;

use Exception;

class UserExceptions extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function UserNotFound()
    {
        return new self('User not found');
    }

    public static function InvalidEmail()
    {
        return new self('email is invalid');
    }

    public static function InvalidPass()
    {
        return new self('Password is invalid');
    }


}