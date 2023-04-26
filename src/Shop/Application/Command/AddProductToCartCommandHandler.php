<?php

namespace App\Shop\Application\Command;


use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\Cart\CartProducts;
use App\Shop\Domain\Cart\CartProductsInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductInterface;
use App\Shop\Domain\User\UserInterface;

class AddProductToCartCommandHandler implements CommandHandlerInterface
{

    private UserInterface $userInterface;
    private ProductInterface $prodInterface;
    private CartInterface $cartInterface;
    private CartProductsInterface $cartProductsInterface;

    public function __construct
    (
        ProductInterface      $prodInterface,
        CartInterface         $cartInterface,
        UserInterface         $userInterface,
        CartProductsInterface $cartProductsInterface)
    {
        $this->userInterface = $userInterface;
        $this->prodInterface = $prodInterface;
        $this->cartInterface = $cartInterface;
        $this->cartProductsInterface = $cartProductsInterface;

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(AddProductToCartCommand $command): void
    {
        $product = $this->prodInterface->findProductByID($command->getProductID());
        $this->guardProduct($product);

        $cart = $this->cartInterface->findCartByUserID($command->getUserID());


        if (!$cart) {

            $user = $this->userInterface->findUserByID($command->getUserID());
            $cart = new Cart($user);
            $this->cartInterface->saveCart($cart);
        }

        $prodInCart = $this->cartProductsInterface->findCartProductByCartAndProductID($cart->getId(), $command->getProductID());
        if ($prodInCart) {

            $prodInCart->setCountPlus();
            $this->cartProductsInterface->flushCartProducts();

        } else {

            $cartProducts = new CartProducts($cart, $product, 0);
            $cartProducts->setCountPlus();
            $cart->getProducts()->add($cartProducts);
            $this->cartInterface->saveCart($cart);
        }
    }

    /**
     * @throws CartExceptions
     */
    private function guardProduct(?Product $prod): void
    {
        if (!$prod) {
            throw CartExceptions::productNotFound();
        }
    }

//    /**
//     * @throws CartExceptions
//     */
//    private function guardUserByID(int $userID): User
//    {
//        $user = $this->userInterface->findUserByID($userID);
//        if (!$user) {
//            throw CartExceptions::userNotFound();
//        } else {
//            return $user;
//        };
//
//    }
//
//    private function cartExists(int $userID): bool
//    {
//        if (!$this->cartInterface->findCartByUserID($userID)) {
//            return false;
//        } else {
//            return true;
//        }
//    }
//
//    private function retrieveCart(int $userID): Cart
//    {
//        return $this->cartInterface->findCartByUserID($userID);
//    }

    private function checkProdInCartExistence(int $idProd, int $idCart): bool
    {
        if ($this->cartProductsInterface->findCartProductByCartAndProductID($idCart, $idProd)) {
            return true;
        } else {
            return false;
        }
    }

}