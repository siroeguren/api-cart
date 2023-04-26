<?php

namespace App\Shop\Application\Command;


use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;

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
        $cart = $this->cartInterface->findCartByID($command->getCartID());
        $this->checkCartExistence($cart);
        $this->cartInterface->removeCart($cart);

    }

    /**
     * @throws CartExceptions
     */
    private function checkCartExistence(?Cart $cart): void
    {
        if (!$cart) {
            $this->throwCartExistsException();
        }
    }

    /**
     * @throws CartExceptions
     */
    private function throwCartExistsException()
    {
        throw CartExceptions::cartNotFound();
    }
}
