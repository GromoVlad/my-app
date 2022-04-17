<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class RegisterDto
{
    public function __construct(private string $name, private string $email, private string $password)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    #[Pure] #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string"])]
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
