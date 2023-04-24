<?php

namespace App\Shop\Application\Command;

class AddProductToCartCommand
{
    public function __construct
    (
        private readonly int $productID,
        private readonly int $count,
        private readonly int $userID
    )
    {

    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @return int
     */
    public function getProductID(): int
    {
        return $this->productID;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}