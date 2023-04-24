<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Domain\User;


use App\Shop\Domain\Products\PriceVO\PriceVO;

class Product
{

    private int $id;


    private string $name;


    private PriceVO $price;

    /**
     * @return PriceVO
     */
    public function getPrice(): PriceVO
    {
        return $this->price;
    }

    private int $stock;

    // Constructor
    public function __construct(string $name, PriceVO $price, int $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }


}
