<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\AddProductToCartCommand;
use App\Shop\Application\Command\AddProductToCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\Cart\CartProducts;
use App\Shop\Domain\Cart\CartProductsInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductInterface;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AddProductToCartCommandHandlerTest extends TestCase
{

    private AddProductToCartCommandHandler $sut;

    private UserInterface|MockObject $userInterface;
    private ProductInterface|MockObject $prodInterface;
    private CartInterface|MockObject $cartInterface;
    private CartProductsInterface|MockObject $cartProdInterface;

    protected function setUp(): void
    {
        $mockedUserInterface = $this->userInterface = $this->createConfiguredMock(UserInterface::class,
            [
                'findUserByID' => $this->createMock(User::class)
            ]);
        $mockedProdInterface = $this->prodInterface = $this->createConfiguredMock(ProductInterface::class,
            [
                'findProductByID' => $this->createMock(Product::class)
            ]);
        $mockedCartInterface = $this->cartInterface = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByID' => $this->createMock(Cart::class)
            ]);
//        $mockedCartInterface = $this->cartInterface->method('getId')->willReturn(2);

        $mockedCartProdInterface = $this->cartProdInterface = $this->createConfiguredMock(CartProductsInterface::class,
            [
                'findCartProductByCartAndProductId' => $this->createMock(CartProducts::class)
            ]);

        $this->sut = new AddProductToCartCommandHandler(
            $mockedProdInterface,
            $mockedCartInterface,
            $mockedUserInterface,
            $mockedCartProdInterface,
        );
    }

    /**
     * @test
     * testInvoke
     * @group add_prod_to_cart_command_handler
     */
    public function testInvoke()
    {
        $this->expectNotToPerformAssertions();
        $command = $this->createConfiguredMock(AddProductToCartCommand::class,
            [
                'getUserID' => 1,
                'getProductID' => 1,
            ]
        );
        $mockedCartInterfaceForInvoke = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByUserID' => $this->createConfiguredMock(Cart::class,
                    [
                        'getId' => 1
                    ])
            ]);

        $newSut = new AddProductToCartCommandHandler(
            $this->prodInterface,
            $mockedCartInterfaceForInvoke,
            $this->userInterface,
            $this->cartProdInterface,
        );
        $newSut->__invoke($command);
    }

    /**
     * @test
     * shouldGetProductNotFoundException
     * @group add_prod_to_cart_command_handler
     */
    public function shouldGetProductNotFoundException()
    {
        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::productNotFound()->getMessage());
        $mockedProdInterface = $this->prodInterface = $this->createConfiguredMock(ProductInterface::class,
            [
                'findProductByID' => null
            ]);

        $mockedCartInterfaceForProductException = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByUserID' => $this->createConfiguredMock(Cart::class,
                    [
                        'getId' => 1
                    ])
            ]);
        $this->cartInterface->method('getId')->willReturn(2);
        $this->sut = new AddProductToCartCommandHandler(
            $mockedProdInterface,
            $mockedCartInterfaceForProductException,
            $this->userInterface,
            $this->cartProdInterface,
        );

        $this->sut->__invoke($this->createMock(AddProductToCartCommand::class));
    }

}
