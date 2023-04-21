<?php

namespace App\Cart\Application\Service\DTOs;

use App\Cart\Domain\Entity\Cart\PriceVO;

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
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}