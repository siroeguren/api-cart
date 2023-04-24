<?php

namespace App\Shop\Infrastructure\Controller;
;


use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\DeleteProdFromCartCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProdFromCartController
{


    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }
    
    #[Route('/deleteProdFromCart/{cartID}/{prodID}', name: 'deleteProdFromCart', methods: ['DELETE'])]
    public function deleteProdFromCartById(int $cartID, int $prodID): JsonResponse
    {
        $command = new DeleteProdFromCartCommand($cartID, $prodID);
        $this->handler->dispatchCommand($command);

        return new JsonResponse('Borrado correctamente');
    }


}