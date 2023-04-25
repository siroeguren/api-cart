<?php

namespace App\Shop\Domain\Product\PriceVO;

use App\Shop\Domain\Product\PriceVO\Service\CurrencyConverter;
use App\Shop\Domain\Product\PriceVO\Service\CurrencyConverterExceptions;

class PriceVO
{

    private const AVAILABLE_CURRENCY = ['EUR', 'USD', 'JPY'];

    private float $amount;

    private string $currency;


    /**
     * @throws \Exception
     */
    public function __construct(float $amount, string $currency)
    {
        if (!in_array($currency, self::AVAILABLE_CURRENCY)) {

            throw  CurrencyConverterExceptions::CurrencyNotFound();

        } else {

            $currencyConverter = new CurrencyConverter();
            $this->amount = $currencyConverter->convertToEUR($amount, $currency);
        }
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

}