<?php

namespace App\Tests\Cart;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    /**
     * @test
     * itShouldThrowException
     * @group product_test
     */
    public function itShouldThrowException(): void
    {
        $this->expectException();
    }
}