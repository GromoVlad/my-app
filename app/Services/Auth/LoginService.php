<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\Auth\LoginDto;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class LoginService
{
    public function __construct(private TokenRepository $tokenRepository)
    {
    }

    /**
     * @throws NotFoundException
     */
    public function login(LoginDto $dto): string
    {
        $isVerify = Auth::attempt($dto->toArray());
        if (!$isVerify) {
            throw new NotFoundException("Неверный email или пароль");
        }
        $tokens = $this->tokenRepository->forUser(Auth::user()->id);
        $tokens->each(function ($value) {
            if (!$value->revoked) {
                $this->tokenRepository->revokeAccessToken($value->id);
            }
        });
        return Auth::user()->createToken('authToken')->accessToken;
    }
}
