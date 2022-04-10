<?php

declare(strict_types=1);

namespace App\Repository\Auth;

use App\Dto\Auth\RegisterDto;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where(['email' => $email])->first();
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOrFailByEmail(string $email): User
    {
        return User::where(['email' => $email])->firstOrFail();
    }

    public function store(RegisterDto $dto): void
    {
        User::create($dto->toArray());
    }
}
