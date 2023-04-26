<?php

namespace App\Shop\Domain\User;

interface UserInterface
{
    public function saveUser(User $user): void;

    public function removeUser(User $user): void;

    public function findUserByID(int $idUser): ?User;
}
