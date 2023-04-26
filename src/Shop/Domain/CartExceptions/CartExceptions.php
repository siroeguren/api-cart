<?php

namespace App\Shop\Domain\CartExceptions;

use Exception;

class CartExceptions extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function cartNotFound()
    {
        return new self('Carrito no encontrado');
    }

    public static function productNotFound()
    {
        return new self('Producto no encontrado');
    }

    public static function userNotFound()
    {
        return new self('Usuario no encontrado');
    }

    public static function cartProductNotFound()
    {
        return new self('Producto no encontrado en el carrito');
    }
}