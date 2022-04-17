<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Dto\Auth\RegisterDto;
use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6|max:255',
        ];
    }

    public function toDTO(): RegisterDto
    {
        return new RegisterDto(
            $this->input('name'),
            $this->input('email'),
            $this->input('password')
        );
    }
}
