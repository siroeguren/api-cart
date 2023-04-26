<?php

namespace App\Shop\Infrastructure\Controller;
;

use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\DeleteCartCommand;
use App\Shop\Domain\CartExceptions\CartExceptions;
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