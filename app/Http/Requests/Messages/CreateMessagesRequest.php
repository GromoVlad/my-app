<?php

declare(strict_types=1);

namespace App\Http\Requests\Messages;

use App\Exceptions\BadRequestException;
use App\Exceptions\InvariantViolationException;
use App\ValueObjects\NotEmptyString;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateMessagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required|string|min:1|max:512',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле является обязательным',
            '*.string' => 'Ожидается строка',
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

    /**
     * @throws InvariantViolationException
     */
    public function toVO(): NotEmptyString
    {
        return new NotEmptyString($this->input('text'));
    }
}
