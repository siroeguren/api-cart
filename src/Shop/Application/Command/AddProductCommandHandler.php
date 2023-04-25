<?php

namespace App\Shop\Application\Command;


use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Product\PriceVO\PriceVO;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductInterface;


class AddProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly ProductInterface $prodInterface)
    {

    }

    /**
     * @throws \Exception
     */
    public function __invoke(AddProductCommand $command)
    {
        $randomCurrencies = ['EUR', 'USD', 'YEN'];
        // Create a new Product entity
        $product = new Product($command->getName(), new PriceVO($command->getPrice(),
            $randomCurrencies[array_rand($randomCurrencies)]), $command->getStock());

        // Persist the Product entity to the database
        $this->prodInterface->saveProduct($product);

        return $product;
    }
}