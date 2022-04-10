<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Validation\UnauthorizedException;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        throw new UnauthorizedException('Пользователь не авторизован');
    }
}
