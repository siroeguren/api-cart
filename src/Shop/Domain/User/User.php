<?php

namespace App\Shop\Domain\User;


class User
{
    // Constructor
    public function __construct(string $name, EmailVO $email, PasswordVO $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

    }

    private int $id;


    private string $name;


    private EmailVO $email;


    private PasswordVO $password;


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

    public function getPassword(): PasswordVO
    {
        return $this->password;
    }

    public function setPassword(PasswordVO $password): void
    {
        $this->password = $password;
    }

}
