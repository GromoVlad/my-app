<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Dto\Auth\LoginDto;
use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6|max:255',
        ];
    }

    public function toDTO(): LoginDto
    {
        return new LoginDto(
            $this->input('email'),
            $this->input('password')
        );
    }
}
