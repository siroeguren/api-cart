<?php

namespace App\Cart\Domain\Entity\Cart;

interface CartInterface
{
    public function saveCart($cart): void;

    public function removeCart($cart): void;

    public function findCartByID($idCart): ?Cart;

    public function findCartByUserID($idUser): ?Cart;
}