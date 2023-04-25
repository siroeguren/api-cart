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
use PHPUnit\Framework\MockObject\Exception;
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
                'findCartByUserID' => $this->createMock(Cart::class)
            ]);
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
                'getProductID' => 3,
            ]
        );
        $this->sut->__invoke($command);
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

        $this->sut = new AddProductToCartCommandHandler(
            $mockedProdInterface,
            $this->cartInterface,
            $this->userInterface,
            $this->cartProdInterface,
        );

        $this->sut->__invoke($this->createMock(AddProductToCartCommand::class));
    }


    /**
     * @test
     * shouldGetCartNotFoundException
     * @group add_prod_to_cart_command_handler
     * @throws Exception
     */

    
    // TODO //
    public function shouldGetCartNotFoundException()
    {
        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::cartNotFound()->getMessage());
        $this->cartInterface = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByUserID' => null
            ]);

        $this->sut = new AddProductToCartCommandHandler(
            $this->prodInterface,
            $this->cartInterface,
            $this->userInterface,
            $this->cartProdInterface,
        );

        $this->sut->__invoke($this->createMock(AddProductToCartCommand::class));
    }
}
