<?php

namespace App\Cart\Domain\Entity\Cart;

interface ProductInterface
{
    public function saveProduct(Product $product): void;

    public function removeProduct(Product $product): void;

    public function findProductByID(int $idProduct): ?Product;
    

}