<?php

namespace App\Cart\Infrastructure\Controller;

use App\Cart\Application\Command\AddProductToCartCommand;
use App\Cart\Application\Command\AddProductToCartHandler;
use App\Cart\Application\Service\AddToCartService;
use App\Cart\Domain\CartExceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddToCartController extends AbstractController
{
    /**
     * @throws \Exception
     */

    public function __construct(private readonly AddProductToCartHandler $handler)
    {
    }

    #[Route('/addToCart', name: 'addToCart', methods: ['POST'])]
    public function addProductToCart(Request $request): Response
    {
        try {
            // Retrieve data from the request
            $idUser = $request->request->get('idUser');
            $idProduct = $request->request->get('idProduct');
            $quantity = $request->request->get('quantity');

            $command = new AddProductToCartCommand($idProduct, 1, $idUser);
            ($this->handler)($command);
            // Call the AddProductService to add the product

            return new Response('Articulo agregado correctamente, ');
        } catch (CartExceptions $e) {
            return new Response('Articulo agregado qweqweqweqweqweqweqedqdsa, ');
        }
    }
}
