<?php

namespace App\Tests\Shop\Domain\Product\PriceVO\Service;

use App\Shop\Domain\Product\PriceVO\Service\CurrencyConverter;
use App\Shop\Domain\Product\PriceVO\Service\CurrencyConverterExceptions;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    private CurrencyConverter $sut;

    private CurrencyConverterExceptions $exceptions;

    protected function setUp(): void
    {
        $this->sut = new CurrencyConverter();
    }

    /**
     * @test
     * shouldReturnProperEurFromUSD
     * @group currency_converter
     * @throws \Exception
     */
    public function shouldReturnProperEurFromUSD()
    {
//        $this->assertEquals(0, $this->sut->convertToEUR(0, 'USD'));
        $this->assertEquals(0.91 * 0.91, $this->sut->convertToEUR(0.91, 'USD'));
//        $this->sut->convertToEUR(1, 'unknown');
    }

    /**
     * @test
     * shouldReturnProperEurFromJPY
     * @group currency_converter
     * @throws \Exception
     */
    public function shouldReturnProperEurFromJPY()
    {
        $this->assertEqualsWithDelta(46.24, $this->sut->convertToEUR(6800, 'JPY'), 0.1);
    }

    /**
     * @test
     * shouldReturnCurrencyNotFoundException
     * @group currency_converter
     * @throws CurrencyConverterExceptions
     */
    public function shouldReturnCurrencyNotFoundException()
    {
        $this->expectException(CurrencyConverterExceptions::class);
        $this->sut->convertToEUR(1, 'unknown');

    }
}
