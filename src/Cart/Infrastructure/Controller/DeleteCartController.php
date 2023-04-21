<?php

namespace App\Cart\Infrastructure\Controller;
;

use App\Cart\Application\Service\DeleteCartService;
use App\Cart\Domain\CartExceptions\CartExceptions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCartController
{


    /**
     * @throws CartExceptions
     */
    #[Route('/deleteCart/{cartID}', name: 'deleteCart', methods: ['DELETE'])]
    public function deleteAllProducts(
        int               $cartID,
        DeleteCartService $deleteCartService
    ): JsonResponse
    {

        $deleteCartService->deleteCart($cartID);

        return new JsonResponse('Borrado correctamente');
    }


}