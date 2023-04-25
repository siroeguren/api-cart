<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Domain\Product\Product;
use PHPUnit\Framework\TestCase;

class AddProductCommandHandlerTest extends TestCase
{

    /**
     * @test
     * testInvoke
     * @group add_prod_command_handler
     * @throws \Exception
     */
    public function testInvoke()
    {
        $this->assertInstanceOf(Product::class,);
    }

}
