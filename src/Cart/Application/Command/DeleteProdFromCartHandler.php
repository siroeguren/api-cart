<?php

namespace App\Cart\Application\Command;

use App\Cart\Domain\CartExceptions\CartExceptions;
use App\Cart\Domain\Entity\Cart\CartInterface;
use App\Cart\Domain\Entity\Cart\CartProducts;
use App\Cart\Domain\Entity\Cart\CartProductsInterface;
use App\Cart\Domain\Entity\Cart\ProductInterface;
use App\Shared\Application\Symfony\CommandHandlerInterface;


class DeleteProdFromCartHandler implements CommandHandlerInterface
{


    public function __construct
    (
        private readonly CartInterface         $cartInterface,
        private readonly ProductInterface      $productInterface,
        private readonly CartProductsInterface $cartProductsInterface
    )
    {
    }


    /**
     * @throws CartExceptions
     */
    public function __invoke(DeleteProdFromCartCommand $command): void
    {

        $this->checkCartExistence($command->getCartID());
        $this->checkProdExistence($command->getProductID());
        $cartProduct = $this->checkCartProdExistence($command->getCartID(), $command->getProductID());

        if ($cartProduct->getCount() == 1) {
            $this->cartProductsInterface->removeCartProduct($cartProduct);
        } else if ($cartProduct->getCount() > 1) {
            $cartProduct->setCountMinus();
            $this->cartProductsInterface->flushCartProducts();
        }

    }

    /**
     * @throws CartExceptions
     */
    private function checkCartExistence(int $cartID): void
    {
        if ($this->cartInterface->findCartByID($cartID) == null) {
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


    /**
     * @throws CartExceptions
     */
    private function checkProdExistence(int $cartID): void
    {
        if ($this->productInterface->findProductByID($cartID) == null) {
            $this->throwCartExistsException();
        }
    }

    /**
     * @throws CartExceptions
     */
    private function throwProdExistsException()
    {
        throw CartExceptions::productNotFound();
    }


    /**
     * @throws CartExceptions
     */
    private function checkCartProdExistence(int $cartID, int $prodID): CartProducts
    {
        $cartProd = $this->cartProductsInterface->findCartProductByCartAndProductID($cartID, $prodID);
        if (!$cartProd) {
            $this->throwCartProdExistsException();
        } else {
            return $cartProd;
        }
    }

    /**
     * @throws CartExceptions
     */
    private function throwCartProdExistsException()
    {
        throw CartExceptions::cartProductNotFound();
    }


}