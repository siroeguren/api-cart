<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\AddProductCommand;
use App\Shop\Application\Command\AddProductCommandHandler;
use App\Shop\Domain\Product\ProductInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AddProductCommandHandlerTest extends TestCase
{
    private AddProductCommandHandler $sut;

    private ProductInterface|MockObject $mockedProdInterface;


    protected function setUp(): void
    {
        $this->mockedProdInterface = $this->createMock(ProductInterface::class);
        $this->sut = new AddProductCommandHandler($this->mockedProdInterface);
    }

    /**
     * @test
     * testInvoke
     * @group add_prod_command_handler
     * @throws \Exception
     */
    public function testInvoke()
    {
        $this->expectNotToPerformAssertions();
        $command = $this->createMock(AddProductCommand::class);
        $this->sut->__invoke($command);

    }

}
