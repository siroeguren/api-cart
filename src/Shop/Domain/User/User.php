<?php

namespace App\Shop\Domain\User;


use App\Shop\Domain\User\VOs\EmaiLVO;
use App\Shop\Domain\User\VOs\PassVO;

class User
{
    // Constructor
    public function __construct(string $name, EmailVO $email, PassVO $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

    }

    private int $id;


    private string $name;


    private EmailVO $email;


    private PassVO $password;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): EmailVO
    {
        return $this->email;
    }

    public function setEmail(EmailVO $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): PassVO
    {
        return $this->password;
    }

    public function setPassword(PassVO $password): void
    {
        $this->password = $password;
    }

}
