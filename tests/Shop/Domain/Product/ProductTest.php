<?php

namespace App\Tests\Shop\Domain\Product;

use App\Shop\Domain\Product\PriceVO\PriceVO;
use App\Shop\Domain\Product\Product;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private PriceVO|MockObject $priceMocked;

    private Product $sut;

    protected function setUp(): void
    {
        $this->priceMocked = $this->createConfiguredMock(PriceVO::class,
            [
                'amount' => 1200.05
            ]);
        $this->sut = new Product('CartTest Product', $this->priceMocked, 100);
    }

    /**
     * @test
     * shouldCreateProduct
     * @group product
     */
    public function shouldCreateProduct()
    {
        $this->assertSame('CartTest Product', $this->sut->getName());
        $this->assertEquals($this->priceMocked, $this->sut->getPrice());
        $this->assertSame(100, $this->sut->getStock());
    }

    /**
     * @test
     * shouldSetName
     * @group product
     */
    public function shouldSetName()
    {
        $product = new Product('CartTest Product', $this->priceMocked, 100);
        $product->setName('New Name');
        $this->assertSame('New Name', $product->getName());
    }

    /**
     * @test
     * should_get_name
     * @group product
     */
    public function shouldGetName()
    {
        $sut = new Product(name: 'CartTest Product', price: $this->priceMocked, stock: 255);
        $this->assertEquals('CartTest Product', $sut->getName());
    }

    /**
     * @test
     * shouldSetStock
     * @group product
     */
    public function shouldSetStock()
    {
        $product = new Product('CartTest Product', $this->priceMocked, 100);
        $product->setStock(50);
        $this->assertSame(50, $product->getStock());
    }

    /**
     * @test
     * shouldGetStock
     * @group product
     */

    public function shouldGetStock()
    {
        $sut = new Product(name: 'ProductTest', price: $this->priceMocked, stock: 255);
        $this->assertEquals(255, $sut->getStock());
    }

}
