<?php

namespace App\Tests\Shop\Domain\Product;

use App\Shop\Domain\Product\PriceVO\PriceVO;
use App\Shop\Domain\Product\PriceVO\Service\CurrencyConverterExceptions;
use PHPUnit\Framework\TestCase;

class PriceVOTest extends TestCase
{
    /**
     * @test
     * itShouldThrowExceptionWhenCurrencyNotValid
     * @group price_vo_test
     * @throws \Exception
     */
    public function itShouldThrowExceptionWhenCurrencyNotValid()
    {
        $this->expectException(CurrencyConverterExceptions::class);
        new PriceVO(amount: 250, currency: 'qwe');

    }

    /**
     * @test
     * itShouldReturnAmount
     * @group price_vo_test
     * @throws \Exception
     */
    public function itShouldReturnAmount()
    {
        $sut = new PriceVO(amount: 250, currency: 'EUR');
        $this->assertEquals(250, $sut->amount());
    }

    /**
     * @test
     * itShouldReturnAmount
     * @group price_vo_test
     */
    public function shouldBeProperClass()
    {
        $price = new PriceVO(100, 'EUR');
        $this->assertInstanceOf(PriceVO::class, $price);
        $this->assertEquals(100, $price->amount());

    }
}