<?php

namespace App\Cart\Infrastructure\Controller;


use App\Cart\Application\Query\ShowCartHandler;
use App\Cart\Application\Query\ShowCartQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCartController
{
    public function __construct(private readonly ShowCartHandler $handler)
    {
    }

    #[Route('/showCart/{idUser}', name: 'showPepe', methods: ['GET'])]
    public function showCart(int $idUser): JsonResponse
    {

        $query = new ShowCartQuery($idUser);
        $cart = ($this->handler)($query);

        return new JsonResponse
        (
            $cart->getProducts(), Response::HTTP_OK
        );

    }
}
