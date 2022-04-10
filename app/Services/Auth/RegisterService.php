<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\Auth\RegisterDto;
use App\Exceptions\AlreadyExistsException;
use App\Repository\Auth\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @throws AlreadyExistsException
     */
    public function register(RegisterDto $dto): void
    {
        $user = $this->userRepository->findByEmail($dto->getEmail());
        if ($user) {
            throw new AlreadyExistsException("Пользователь с email {$dto->getEmail()} был ранее зарегистрирован");
        }
        $hash = Hash::make($dto->getPassword());
        $dto->setPassword($hash);
        $this->userRepository->store($dto);
    }
}
