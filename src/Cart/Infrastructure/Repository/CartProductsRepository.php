<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */


namespace App\Cart\Infrastructure\Repository;

use App\Cart\Domain\CartExceptions\CartExceptions;
use App\Cart\Domain\Entity\Cart\CartProducts;
use App\Cart\Domain\Entity\Cart\CartProductsInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;


class CartProductsRepository extends ServiceEntityRepository implements CartProductsInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProducts::class);
    }

    public function saveCartProduct($cartProducts): void
    {
        $this->getEntityManager()->persist($cartProducts);
        $this->getEntityManager()->flush();

    }

    public function removeCartProduct($cartProduct): void
    {
        $this->getEntityManager()->remove($cartProduct);
        $this->getEntityManager()->flush();

    }


    /**
     * @throws CartExceptions
     */
    public function findCartProductByCartID($idCart): CartProducts
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cart_id = :val')
            ->setParameter('val', $idCart)
            ->getQuery()
            ->getResult();


    }

    /**
     * @throws NonUniqueResultException
     */
    public function findCartProductByCartAndProductID($idCart, $idProduct): ?CartProducts
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cart = :cart')
            ->andWhere('c.product = :product')
            ->setParameter('cart', $idCart)
            ->setParameter('product', $idProduct)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function findCartProductByProductID(int $idProduct): array
    {

        return $this->createQueryBuilder('c')
            ->andWhere('c.product = :val')
            ->setParameter('val', $idProduct)
            ->getQuery()
            ->getResult();
    }


    public function flushCartProducts(): void
    {
        $this->getEntityManager()->flush();
    }

}

