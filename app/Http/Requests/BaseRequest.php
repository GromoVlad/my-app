<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['*.required' => "string", '*.string' => "string", '*.alpha_num' => "string", '*.email' => "string", '*.min' => "string", '*.max' => "string"])]
    public function messages(): array
    {
        return [
            '*.required' => 'Поле является обязательным',
            '*.string' => 'Ожидается строка',
            '*.alpha_num' => 'В данном поле ожидается только буквенно-цифровые символы',
            '*.email' => 'В данном поле ожидается адрес электронной почты',
            '*.min' => 'Минимальная длина должна составлять :min знаков',
            '*.max' => 'Максимальная длина должна быть не болшьше :max знаков',
        ];
    }

    /**
     * @throws BadRequestException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new BadRequestException('Ошибка валидации', null, $validator->errors()->messages());
    }
}
