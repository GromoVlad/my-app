<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class LoginDto
{
    public function __construct(private string $email, private string $password)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    #[Pure] #[ArrayShape(['email' => "string", 'password' => "string"])]
    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
