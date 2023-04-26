<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteCartCommand;
use PHPUnit\Framework\TestCase;

class DeleteCartCommandTest extends TestCase
{
    private DeleteCartCommand $sut;

    protected function setUp(): void
    {
        $this->sut = new DeleteCartCommand(15);
    }

    /**
     * @test
     * shouldGetProperCartID
     * @group delete_cart_command_test
     */
    public function shouldGetProperCartID()
    {
        $this->assertEquals(15, $this->sut->getCartID());
    }
}
