<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Cart\Infrastructure\Repository;


use App\Cart\Domain\Entity\Cart\Cart;
use App\Cart\Domain\Entity\Cart\CartInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;


class CartRepository extends ServiceEntityRepository implements CartInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function saveCart($cart): void
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush();
    }

    public function removeCart($cart): void
    {
        $this->getEntityManager()->remove($cart);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findCartByUserID($idUser): ?Cart
    {

        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder
            ->select('a')
            ->from(Cart::class, 'a')
            ->where('a.user = :userId')
            ->setParameter('userId', $idUser);
        
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


    public function findCartByID($idCart): Cart
    {
        return $this->getEntityManager()->find(Cart::class, $idCart);

    }
}