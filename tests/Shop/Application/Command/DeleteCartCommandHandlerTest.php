<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteCartCommandHandler;
use App\Shop\Domain\Cart\CartInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteCartCommandHandlerTest extends TestCase
{
    private DeleteCartCommandHandler $sut;

    private CartInterface|MockObject $cartInterface;

    protected function setUp(): void
    {
        
    }
}
