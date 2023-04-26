<?php

namespace App\Shop\Domain\User;


class PasswordVO
{
    private string $password;

    public function __construct($password)
    {
        if (!$this->validate($password)) {
            throw UserExceptions::InvalidPass();
        }
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function validate($password)
    {
        $regex = '/^(?=.*[A-Z])(?=.*\d).+$/';
        return preg_match($regex, $password) === 1;
    }
}
