<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Dto\Auth\RegisterDto;
use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле является обязательным',
            '*.string' => 'Ожидается строка',
            '*.alpha_num' => 'В данном поле ожидается только буквенно-цифровые символы',
            '*.email' => 'В данном поле ожидается адрес электронной почты',
            '*.min' => 'Минимальная длина должна составлять :min знаков',
            '*.max' => 'Максимальная длина должна быть не больше :max знаков',
        ];
    }

    /**
     * @throws BadRequestException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new BadRequestException('Ошибка валидации', null, $validator->errors()->messages());
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
