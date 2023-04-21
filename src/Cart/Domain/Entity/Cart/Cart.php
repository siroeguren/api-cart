<?php

namespace App\Cart\Domain\Entity\Cart;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Cart
{

    private int $id;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    private User $user;

    private Collection $products;


    public function __construct(?User $user)
    {
        $this->user = $user;
        $this->products = new ArrayCollection();
    }

    public function Id(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function setProducts(Collection $products): Collection
    {
        $this->products->add($products);
        return $this->products;
    }


}
