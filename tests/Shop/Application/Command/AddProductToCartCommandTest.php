<?php

namespace App\Tests\Shop\Application\Command;


use App\Shop\Application\Command\AddProductToCartCommand;
use PHPUnit\Framework\TestCase;

class AddProductToCartCommandTest extends TestCase
{

    private AddProductToCartCommand $sut;

    protected function setUp(): void
    {
        $this->sut = new AddProductToCartCommand(1, 6, 2);
    }

    /**
     * @test
     * shouldGetProperProdID
     * @group add_prod_to_cart_command
     */
    public function shouldGetProperProdID()
    {
        $this->assertEquals(1, $this->sut->getProductID());
    }


    /**
     * @test
     * shouldGetProperUserID
     * @group add_prod_to_cart_command
     */
    public function shouldGetProperUserID()
    {
        $this->assertEquals(2, $this->sut->getUserID());
    }


    /**
     * @test
     * shouldGetProperCount
     * @group add_prod_to_cart_command
     */
    public function shouldGetProperCount()
    {
        $this->assertEquals(6, $this->sut->getCount());
    }
}
