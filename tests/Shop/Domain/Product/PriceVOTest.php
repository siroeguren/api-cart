<?php

namespace App\Tests\Shop\Domain\Product;

use App\Shop\Domain\Product\PriceVO\PriceVO;
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
        $this->expectExceptionMessage('Sentimos las molestias, no trabajamos con la moneda');
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

//    /**
//     * @test
//     * itShouldReturnAmount
//     * @group price_vo_test
//     */
//    public function shouldConvertCurrencyToEur(): void
//    {
//        $converter = new CurrencyConverter();
//        $this->assertEquals(0, $converter->convertToEUR(0, 'USD'));
//        $this->assertEquals(1, $converter->convertToEUR(0.91, 'USD'), '', 0.01);
//        $this->assertEquals(100, $converter->convertToEUR(6800, 'JPY'), '', 0.01);
//        $this->assertEquals(1.23, $converter->convertToEUR(1.23, 'EUR'));
//        $converter->convertToEUR(1, 'unknown');
//    }

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