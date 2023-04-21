<?php

namespace App\Cart\Domain\Entity\Cart;

interface CartProductsInterface
{
    public function saveCartProduct(CartProducts $cartProducts): void;

    public function removeCartProduct(CartProducts $cartProduct): void;

    public function findCartProductByCartID(int $idCart): CartProducts;

    public function findCartProductByCartAndProductID(int $idCart, int $idProduct): ?CartProducts;

    public function findCartProductByProductID(int $idProduct): array;

    public function flushCartProducts(): void;

}