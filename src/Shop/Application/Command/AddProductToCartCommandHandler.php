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
use App\Shop\Domain\User\User;
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
        $userID = $command->getUserID();
        $product = $this->guardProductByID($command->getProductID());

        //Comprueba que el carrito existe, si es asi, lo recupera.
        //Si no existe crea un carrittto nuevo asociado al ID de usuario
        if ($this->cartExists($userID)) {

            $cart = $this->retrieveCart($command->getUserID());

        } else {
            $cart = new Cart($this->guardUserByID($command->getUserID()));
            $this->cartInterface->saveCart($cart);
        }

        //Comprueba que el producto exista en el carrito, si existe suma 1 al count de ese produco
        //Si no existe procede a crear un cartProduct y a setear su count a 1.
        if ($this->checkProdInCartExistence($command->getProductID(), $cart->Id())) {

            $cartProd = $this->cartProductsInterface
                ->findCartProductByCartAndProductID($cart->Id(), $command->getProductID());
            $cartProd->setCountPlus();
            $this->cartProductsInterface->flushCartProducts();

        } else {
            $cartProducts = new CartProducts($cart, $product);
            $cartProducts->setCountPlus();
            $cart->getProducts()->add($cartProducts);
            $this->cartInterface->saveCart($cart);
        }
    }

    /**
     * @throws CartExceptions
     */
    private function guardProductByID(int $productID): Product
    {
        $prod = $this->prodInterface->findProductByID($productID);
        if (!$prod) {
            throw CartExceptions::productNotFound();
        } else {
            return $prod;
        }
    }

    /**
     * @throws CartExceptions
     */
    private function guardUserByID(int $userID): User
    {
        $user = $this->userInterface->find($userID);
        if (!$user) {
            throw CartExceptions::userNotFound();
        } else {
            return $user;
        };

    }

    private function cartExists(int $userID): bool
    {
        if (!$this->cartInterface->findCartByUserID($userID)) {
            return false;
        } else {
            return true;
        };
    }

    private function retrieveCart(int $userID): Cart
    {
        return $this->cartInterface->findCartByUserID($userID);
    }

    private function checkProdInCartExistence(int $idProd, int $idCart): bool
    {
        if ($this->cartProductsInterface->findCartProductByCartAndProductID($idCart, $idProd)) {
            return true;
        } else {
            return false;
        }
    }

}