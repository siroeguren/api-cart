<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Infrastructure\Repository;


use App\Shop\Domain\Products\Product;
use App\Shop\Domain\Products\ProductInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function saveProduct(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    public function removeProduct(Product $product): void
    {
        $this->getEntityManager()->remove($product);
        $this->getEntityManager()->flush();

    }

    public function findProductByID($idProduct): Product
    {
        return $this->getEntityManager()->find(Product::class, $idProduct);

    }
}
