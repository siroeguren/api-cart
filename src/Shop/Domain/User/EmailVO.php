<?php

namespace App\Shop\Domain\User;

class EmailVO
{
    private string $address;

    /**
     * @throws UserExceptions
     */
    public function __construct($address)
    {
        if (!$this->validate($address)) {
            throw UserExceptions::InvalidEmail();
        }
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    private function validate($address)
    {
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($regex, $address) === 1;
    }
}
