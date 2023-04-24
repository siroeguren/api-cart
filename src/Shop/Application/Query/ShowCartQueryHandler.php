<?php

namespace App\Shop\Application\Query;


use App\Shared\Application\Symfony\QueryHandlerInterface;
use App\Shop\Application\Service\DTOs\CartResponseDTO;
use App\Shop\Domain\Cart\CartInterface;

class ShowCartQueryHandler implements QueryHandlerInterface
{
    public function __construct
    (
        private readonly CartInterface $cartInterface,
    )
    {
    }

    public function __invoke(ShowCartQuery $query): CartResponseDTO
    {
        $cart = $this->cartInterface->findCartByUserID($query->getIdUser());
        $response = new CartResponseDTO();

        return CartResponseDTO::assemble($cart);
    }
}