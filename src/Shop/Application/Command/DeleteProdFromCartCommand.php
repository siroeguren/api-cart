<?php

namespace App\Shop\Application\Command;

class DeleteProdFromCartCommand
{
    public function __construct
    (
        private readonly int $cartID,
        private readonly int $productID
    )
    {
    }

    /**
     * @return int
     */
    public function getCartID(): int
    {
        return $this->cartID;
    }

    /**
     * @return int
     */
    public function getProductID(): int
    {
        return $this->productID;
    }
}