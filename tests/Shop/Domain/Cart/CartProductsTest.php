<?php

namespace App\Tests\Shop\Domain\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartProducts;
use App\Shop\Domain\Product\Product;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CartProductsTest extends TestCase
{
    private Cart|MockObject $mockedCart;
    private Product|MockObject $mockedProduct;

    protected function setUp(): void
    {

        $this->mockedCart = $this->createMock(Cart::class);
        $this->mockedProduct = $this->createMock(Product::class);
        $this->sut = new CartProducts($this->mockedCart, $this->mockedProduct);
    }
}
