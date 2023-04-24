<?php

namespace App\Shop\Infrastructure\Controller;


use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Query\ShowCartQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShowCartController
{
    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    #[Route('/showCart/{idUser}', name: 'showPepe', methods: ['GET'])]
    public function showCart(int $idUser): JsonResponse
    {

        $query = new ShowCartQuery($idUser);
        $cart = $this->handler->dispatchQuery($query);
        $cartItems = [];

        foreach ($cart as $cartItem) {
            foreach ($cartItem as $prod) {
                $cartItems[] = [
                    'name' => $prod['name'],
                    'price' => $prod['unitPrice'],
                    'uds' => $prod['uds'],
                ];
            }


        }
        return new JsonResponse ($cartItems);
    }

}
