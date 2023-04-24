<?php

namespace App\Shop\Domain\Cart;

use App\Shop\Domain\Products\Product;

class CartProducts
{
    private ?int $id = null;

    private Cart $cart;

    private Product $product;

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    private ?int $count = null;

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }


    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->product = $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartId(): ?int
    {
        return $this->cart->Id();
    }

    public function getProductId(): ?int
    {
        return $this->product->getId();
    }

    public function setCountMinus(): void
    {
        $this->count--;
    }

    public function setCountPlus(): void
    {
        $this->count++;
    }
}
