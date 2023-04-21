<?php

namespace App\Cart\Infrastructure\Controller;
;

use App\Cart\Application\Command\DeleteProdFromCartCommand;
use App\Cart\Application\Command\DeleteProdFromCartHandler;
use App\Cart\Domain\CartExceptions\CartExceptions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProdFromCartController
{


    public function __construct(private readonly DeleteProdFromCartHandler $handler)
    {
    }

    /**
     * @throws CartExceptions
     */
    #[Route('/deleteProdFromCart/{cartID}/{prodID}', name: 'deleteProdFromCart', methods: ['DELETE'])]
    public function deleteProdFromCartById(int $cartID, int $prodID): JsonResponse
    {
        $command = new DeleteProdFromCartCommand($cartID, $prodID);
        ($this->handler)($command);


        return new JsonResponse('Borrado correctamente');
    }


}