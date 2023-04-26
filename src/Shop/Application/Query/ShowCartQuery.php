<?php

namespace App\Shop\Application\Query;

class ShowCartQuery
{
    public function __construct
    (
        private readonly int $idUser
    )
    {
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }
}