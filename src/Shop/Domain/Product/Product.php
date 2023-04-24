<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Domain\Product;


use App\Shop\Domain\Product\PriceVO\PriceVO;

class Product
{
    // Constructor
    public function __construct(string $name, PriceVO $price, int $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    private int $id;


    private string $name;


    private PriceVO $price;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): PriceVO
    {
        return $this->price;
    }

    private int $stock;


    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
