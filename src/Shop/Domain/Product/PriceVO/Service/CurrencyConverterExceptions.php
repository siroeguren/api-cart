<?php

namespace App\Shop\Domain\Product\PriceVO\Service;

use Exception;

class CurrencyConverterExceptions extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function CurrencyNotFound()
    {
        return new self('Currency not found exception');
    }

    public static function NegativeAmount()
    {
        return new self('Neggative amount exception');
    }

}