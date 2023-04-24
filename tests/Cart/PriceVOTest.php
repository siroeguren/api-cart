<?php

namespace App\Tests\Cart;

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
        $this->assertEquals($sut->amount());
    }
}