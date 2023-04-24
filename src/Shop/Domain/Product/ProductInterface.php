<?php

namespace App\Shop\Domain\Product;


interface ProductInterface
{
    public function saveProduct(Product $product): void;

    public function removeProduct(Product $product): void;

    public function findProductByID(int $idProduct): ?Product;


}