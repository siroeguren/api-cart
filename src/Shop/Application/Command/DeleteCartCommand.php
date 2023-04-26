<?php

namespace App\Shop\Application\Command;

class DeleteCartCommand
{
    public function __construct(private readonly int $cartID)
    {
    }

    /**
     * @return int
     */
    public function getCartID()
    {
        return $this->cartID;
    }
}