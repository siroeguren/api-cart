<?php

namespace App\Cart\Application\Command;

use App\Cart\Domain\Entity\Cart\PriceVO;
use App\Cart\Domain\Entity\Cart\Product;
use App\Cart\Domain\Entity\Cart\ProductInterface;
use App\Shared\Application\Symfony\CommandHandlerInterface;

class AddProductHandler implements CommandHandlerInterface
{
    public function __construct(private readonly ProductInterface $prodInterface)
    {

    }

    /**
     * @throws \Exception
     */
    public function __invoke(AddProductCommand $command)
    {
        $randomCurrencies = ['EUR', 'USD', 'YEN', 'DSAD', 'qnwebnqwe'];
        // Create a new Product entity
        $product = new Product($command->getName(), new PriceVO($command->getPrice(),
            $randomCurrencies[array_rand($randomCurrencies)]), $command->getStock());

        // Persist the Product entity to the database
        $this->prodInterface->saveProduct($product, true);

        return $product;
    }
}