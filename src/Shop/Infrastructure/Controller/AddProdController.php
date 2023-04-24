<?php

namespace App\Shop\Infrastructure\Controller;


use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\AddProductCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AddProdController
{


    public function __construct(private readonly HandlerEventDispatcher $handler)
    {


    }

    /**
     * @throws \Exception
     */
    #[Route('/addProd', name: 'createProduct', methods: ['POST'])]
    public function addProduct(Request $request): Response
    {
        // Retrieve data from the request
        $name = $request->request->get('name');
        $price = $request->request->get('price');
        $stock = $request->request->get('stock');


        $command = new AddProductCommand($name, $price, $stock);
        $this->handler->dispatchCommand($command);
        // Call the AddProductService to add the product

        // Return a response, e.g. a success message or a redirect
        return new Response('Working');
    }

}
