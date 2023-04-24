<?php

namespace App\Shop\Application\Service\DTOs;


use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Products\PriceVO\PriceVO;

class CartResponseDTO
{

    private array $products = [];

    /**
     * @return array
     */

    public function addProdToCartJsonResponse(string $name, PriceVO $unitPrice, int $uds)
    {
        $this->products[] =
            [
                'name' => $name,
                'unitPrice' => $unitPrice->amount(),
                'uds' => $uds
            ];
        return $this->products;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public static function assemble(Cart $cart): self
    {
        $cartDTO = new self();

        foreach ($cart->getProducts() as $cartProduct) {
            $cartDTO->addProdToCartJsonResponse
            (
                $cartProduct->getProduct()->getName(),
                $cartProduct->getProduct()->getPrice(),
                $cartProduct->getCount()
            );
        }
        return $cartDTO;
    }

}