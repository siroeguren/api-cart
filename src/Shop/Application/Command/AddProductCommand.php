<?php

namespace App\Shop\Application\Command;

class AddProductCommand
{
    public function __construct
    (
        private readonly string $name,
        private readonly float  $price,
        private readonly int    $stock,
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }
}