<?php

namespace App\Cart\Application\Query;

use App\Cart\Application\Service\DTOs\CartResponseDTO;
use App\Cart\Domain\Entity\Cart\CartInterface;
use App\Shared\Application\Symfony\QueryHandlerInterface;


class ShowCartHandler implements QueryHandlerInterface
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