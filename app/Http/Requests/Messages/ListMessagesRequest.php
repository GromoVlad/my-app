<?php

declare(strict_types=1);

namespace App\Http\Requests\Messages;

use App\Dto\Auth\LoginDto;
use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ListMessagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [                 ];
    }
/*
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле является обязательным',
            '*.alpha_num' => 'В данном поле ожидается только буквенно-цифровые символы',
            '*.email' => 'В данном поле ожидается адрес электронной почты',
            '*.min' => 'Минимальная длина должна составлять :min знаков',
            '*.max' => 'Максимальная длина должна быть не болшьше :max знаков',
        ];
    }
*/
    /**
     * @throws BadRequestException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new BadRequestException('Ошибка валидации', null, $validator->errors()->messages());
    }

    public function toDTO(): LoginDto
    {
        return new LoginDto(
            $this->input('email'),
            $this->input('password')
        );
    }
}
