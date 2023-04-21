<?php

namespace App\Cart\Domain\Entity\Cart;

class User
{
    // Constructor
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $this->checkEmail($email);
        $this->password = $this->check_pass($password);
    }

    private int $id;


    private string $name;


    private string $email;


    private string $password;

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

    public function getEmail(): string
    {
        return $this->email;
    }


    function checkEmail($email)
    {
        $validator = Validation::createValidator();
        $emailConstraint = new Email();
        $violations = $validator->validate($email, $emailConstraint);

        return count($violations) === 0;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    function check_pass($password)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[0-9]).+$/';
        return preg_match($pattern, $password) === 1;
    }


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}
