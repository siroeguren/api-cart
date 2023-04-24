<?php

namespace App\Shop\Domain\Product\PriceVO;

class CurrencyConverter
{
    public function convertToEUR($amount, $currency)
    {
        switch ($currency) {
            case 'USD':
                return $amount * 0.91;
            case 'JPY':
                return $amount * 0.0068;
            case 'EUR':
                return $amount;
            default:
                throw new \InvalidArgumentException("Unknown currency: $currency");
        }
    }
}
