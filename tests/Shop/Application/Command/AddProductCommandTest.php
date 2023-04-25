<?php

namespace App\Tests\Shop\Application\Command;


use App\Shop\Application\Command\AddProductCommand;
use PHPUnit\Framework\TestCase;

class AddProductCommandTest extends TestCase
{
    private AddProductCommand $sut;

    protected function setUp(): void
    {
        $this->sut = new AddProductCommand('Prod', 20.6, 100);
    }


    /**
     * @test
     * shouldGetProperName
     * @group add_prod_command_test
     */
    public function shouldGetProperName()
    {
        $this->assertEquals('Prod', $this->sut->getName());
    }


    /**
     * @test
     * shouldGetProperPrice
     * @group add_prod_command_test
     */
    public function shouldGetProperPrice()
    {
        $this->assertEquals('20.6', $this->sut->getPrice());
    }


    /**
     * @test
     * shouldGetProperStock
     * @group add_prod_command_test
     */
    public function shouldGetProperStock()
    {
        $this->assertEquals(100, $this->sut->getStock());
    }

}
