<?php

namespace App\Cart\Application\Query;

use App\Cart\Application\Service\DTOs\CartResponseDTO;
use App\Cart\Domain\Entity\Cart\CartInterface;


class ShowCartHandler
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

        foreach ($cart->getProducts() as $cartProduct) {
            $response->addProdToCartJsonResponse
            (
                $cartProduct->getProduct()->getName(),
                $cartProduct->getProduct()->getPrice(),
                $cartProduct->getCount()
            );
        }

        return $response;
    }
}