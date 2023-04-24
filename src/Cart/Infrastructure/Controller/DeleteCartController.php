<?php

namespace App\Cart\Infrastructure\Controller;
;

use App\Cart\Application\Command\DeleteCartCommand;
use App\Cart\Domain\CartExceptions\CartExceptions;
use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCartController
{

    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    /**
     * @throws CartExceptions
     */
    #[Route('/deleteCart/{cartID}', name: 'deleteCart', methods: ['DELETE'])]
    public function deleteAllProducts(int $cartID): JsonResponse
    {
        $command = new DeleteCartCommand($cartID);
        $this->handler->dispatchCommand($command);


        return new JsonResponse('Borrado correctamente');
    }


}