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

    private CartProducts $sut;

    protected function setUp(): void
    {

        $this->mockedCart = $this->createMock(Cart::class);
        $this->mockedProduct = $this->createMock(Product::class);
        $count = 5;
        $this->sut = new CartProducts($this->mockedCart, $this->mockedProduct, $count);
    }

    /**
     * @test
     * shouldBeProperClass
     * @group cart_products
     */
    public function shouldBeProperClass()
    {
        $count = 5;
        $cartProduct = new CartProducts($this->mockedCart, $this->mockedProduct, $count);
        $this->assertInstanceOf(CartProducts::class, $cartProduct);

    }

    /**
     * @test
     * shouldGetProperCount
     * @group cart_products
     */
    public function shouldGetProperCount()
    {
        $this->assertEquals(5, $this->sut->getCount());
    }

    /**
     * @test
     * shouldSetPropperCountMinus
     * @group cart_products
     */
    public function shouldSetProperCountMinus()
    {
        $this->sut->setCountMinus();
        $this->assertEquals(4, $this->sut->getCount());
    }

    /**
     * @test
     * shouldSetProperCountPlus
     * @group cart_products
     */
    public function shouldSetProperCountPlus()
    {
        $this->sut->setCountPlus();
        $this->assertEquals(6, $this->sut->getCount());
    }
}
