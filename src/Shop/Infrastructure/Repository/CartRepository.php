<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Infrastructure\Repository;


use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartInterface;
use App\Shop\Domain\CartExceptions\CartExceptions;
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
     * @throws CartExceptions
     */
    public function findCartByUserID($idUser): ?Cart
    {

        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder
            ->select('a')
            ->from(Cart::class, 'a')
            ->where('a.user = :userId')
            ->setParameter('userId', $idUser);

        $cart = $queryBuilder->getQuery()->getOneOrNullResult();
        
        if ($cart) {
            return $cart;
        } else {
            throw CartExceptions::cartNotFound();
        }
    }


    public function findCartByID($idCart): ?Cart
    {
        $cart = $this->getEntityManager()->find(Cart::class, $idCart);
        if ($cart) {
            return $cart;
        } else {
            throw CartExceptions::cartNotFound();
        }
    }

    public function getId(): int
    {
        // TODO: Implement getId() method.
    }
}