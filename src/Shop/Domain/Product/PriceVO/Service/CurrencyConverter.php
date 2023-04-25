<?php

namespace App\Shop\Domain\Product\PriceVO\Service;

class CurrencyConverter
{
    /**
     * @throws CurrencyConverterExceptions
     */
    public function convertToEUR($amount, $currency)
    {
        $this->checkNegativeAmount($amount);
        switch ($currency) {
            case 'USD':
                return $amount * 0.91;
            case 'JPY':
                return $amount * 0.0068;
            case 'EUR':
                return $amount;
            default:
                throw CurrencyConverterExceptions::CurrencyNotFound();
        }
    }

    /**
     * @throws CurrencyConverterExceptions
     */
    private function checkNegativeAmount(float $amount): void
    {
        if ($amount < 0) {
            throw CurrencyConverterExceptions::NegativeAmount();
        }

    }
}
