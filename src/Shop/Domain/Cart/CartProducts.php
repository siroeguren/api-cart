<?php

namespace App\Shop\Domain\Cart;

use App\Shop\Domain\Product\Product;

class CartProducts
{
    private ?int $id = null;

    private Cart $cart;


    private Product $product;

    private ?int $count = null;

    public function __construct(Cart $cart, Product $product, int $count)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->count = $count;
    }


    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }


    public function setCountMinus(): void
    {
        $this->count--;
    }

    public function setCountPlus(): void
    {
        $this->count++;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart): void
    {
        $this->cart = $cart;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
