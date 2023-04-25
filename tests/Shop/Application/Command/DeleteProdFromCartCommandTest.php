<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteProdFromCartCommand;
use PHPUnit\Framework\TestCase;

class DeleteProdFromCartCommandTest extends TestCase
{
    private DeleteProdFromCartCommand $sut;

    protected function setUp(): void
    {
        $this->sut = new DeleteProdFromCartCommand(cartID: 7, productID: 4);
    }

    /**
     * @test
     * shouldGetProperCartID
     * @group delete_prod_from_cart_test
     */
    public function shouldGetProperCartID()
    {
        $this->assertEquals(7, $this->sut->getCartID());
    }

    /**
     * @test
     * shouldGetProperProdID
     * @group delete_prod_from_cart_test
     */
    public function shouldGetProperProdID()
    {
        $this->assertEquals(4, $this->sut->getProductID());
    }
}
