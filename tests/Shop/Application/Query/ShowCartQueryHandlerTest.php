<?php

namespace App\Tests\Shop\Application\Query;

use App\Shop\Application\Query\ShowCartQuery;
use App\Shop\Application\Query\ShowCartQueryHandler;
use App\Shop\Application\Service\DTOs\CartResponseDTO;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use PHPUnit\Framework\TestCase;

class ShowCartQueryHandlerTest extends TestCase
{
    private ShowCartQueryHandler $sut;

    private CartInterface $cartInterface;

    protected function setUp(): void
    {
        $this->cartInterface = $this->createConfiguredMock(CartInterface::class,
            [
                'findCartByUserID' => $this->createMock(Cart::class)
            ]);
        $this->sut = new ShowCartQueryHandler($this->cartInterface);
    }

    /**
     * @test
     * shouldReturnValidCartResponseDTO
     * @group show-cart-query-handler
     * @throws \Exception
     */
    public function shouldReturnValidCartResponseDTO()
    {
        $this->assertInstanceOf(CartResponseDTO::class,
            $this->sut->__invoke($this->createMock(ShowCartQuery::class)));
    }

}
