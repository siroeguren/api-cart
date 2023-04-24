<?php

namespace App\Shop\Domain\Product\PriceVO;

class PriceVO
{

    private const AVAILABLE_CURRENCY = ['EUR', 'USD', 'JPY'];

    private float $amount;


    /**
     * @throws \Exception
     */
    public function __construct(float $amount, string $currency)
    {
        if (!in_array($currency, self::AVAILABLE_CURRENCY)) {


            throw new \Exception('Sentimos las molestias, no trabajamos con la moneda');

        } else {

            $this->amount = $this->convertCurrencyToEUR($amount, $currency);

        }

    }

    public function amount(): float
    {
        return $this->amount;
    }

    private function convertCurrencyToEUR($amount, $currency)
    {
        switch ($currency) {
            case 'USD' :
                return $amount * 0.91;

            case 'JPY':
                return $amount * 0.0068;

            case 'EUR':
                return $amount;
        }
    }

}