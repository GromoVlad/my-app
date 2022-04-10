<?php

namespace App\Services\Crypto;

class HashService
{
    public function hash(string $password): string
    {
        $salt = config('auth.password_salt');
        return password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt, 'cost' => 10]);
    }
}
