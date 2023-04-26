<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteCartCommand;
use App\Shop\Application\Command\DeleteCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteCartCommandHandlerTest extends TestCase
{
    private DeleteCartCommandHandler $sut;

    private CartInterface|MockObject $cartInterface;

    protected function setUp(): void
    {
        $this->cartInterface = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByID' => $this->createMock(Cart::class)
            ]);
        $this->sut = new DeleteCartCommandHandler($this->cartInterface);
    }

    /**
     * @test
     * shouldDeleteCart
     * @group delete_cart
     */
    public function shouldDeleteCart()
    {
        $this->expectNotToPerformAssertions();
        $command = $this->createConfiguredMock(DeleteCartCommand::class,
            [
                'getCartID' => 1
            ]);
        $this->sut->__invoke($command);
    }

    /**
     * @test
     * shouldGiveCartNotFoundException
     * @group delete_cart
     */
    public function shouldGiveCartNotFoundException()
    {
        $this->expectException(CartExceptions::class);
        $cartInterface = $this->createMock(CartInterface::class);
        $newSut = new DeleteCartCommandHandler($cartInterface);
        $newSut->__invoke($this->createMock(DeleteCartCommand::class));
    }

}
