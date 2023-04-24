<?php

namespace App\Shop\Domain\User;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validation;

class User
{
    // Constructor
    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        if ($this->checkEmail($email)) {
            $this->email = $email;
        }
        if ($this->checkPass($password)) {
            $this->password = $password;
        }
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
        if ($this->checkEmail($email)) {
            $this->email = $email;
        } else {
            throw new \Exception('No es un email valido');
        }
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    function checkPass($password): bool
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[0-9]).+$/';
        return preg_match($pattern, $password) === 1;
    }


    public function setPassword(string $password): void
    {
        if ($this->checkPass($password)) {
            $this->password = $password;
        } else {
            throw new \Exception('Password invalida');
        }
    }


}
