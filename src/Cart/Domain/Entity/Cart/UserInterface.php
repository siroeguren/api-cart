<?php

namespace App\Cart\Domain\Entity\Cart;

interface UserInterface
{
    public function saveUser(User $user): void;

    public function removeUser(User $user): void;

    public function findUserByID(int $idUser): ?User;
}
