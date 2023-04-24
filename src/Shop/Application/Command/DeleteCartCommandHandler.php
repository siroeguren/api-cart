<?php

namespace App\Shop\Application\Command;


use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartExceptions\CartExceptions;
use App\Shop\Domain\Cart\CartInterface;

class DeleteCartCommandHandler implements CommandHandlerInterface
{


    public function __construct
    (
        private readonly CartInterface $cartInterface,
    )
    {
    }


    /**
     * @throws CartExceptions
     */
    public function __invoke(DeleteCartCommand $command): void
    {

        $this->checkCartExistence($command->getCartID());
        $cart = $this->checkCartExistence($command->getCartID());
        $this->cartInterface->removeCart($cart);

    }

    /**
     * @throws CartExceptions
     */
    private function checkCartExistence(int $cartID): ?Cart
    {
        return $this->cartInterface->findCartByID($cartID) ?: $this->throwCartExistsException();
    }

    /**
     * @throws CartExceptions
     */
    private function throwCartExistsException()
    {
        throw CartExceptions::cartNotFound();
    }
}
