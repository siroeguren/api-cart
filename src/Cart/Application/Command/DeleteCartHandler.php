<?php

namespace App\Cart\Application\Command;

use App\Cart\Domain\CartExceptions\CartExceptions;
use App\Cart\Domain\Entity\Cart\Cart;
use App\Cart\Domain\Entity\Cart\CartInterface;
use App\Shared\Application\Symfony\CommandHandlerInterface;

class DeleteCartHandler implements CommandHandlerInterface
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
