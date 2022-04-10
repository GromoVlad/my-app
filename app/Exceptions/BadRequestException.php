<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Exception;
use Throwable;

class BadRequestException extends Exception
{
    /** @var array|null */
    private $validationErrors;

    public function __construct(string $message, Throwable $previous = null, array $validationErrors = null)
    {
        parent::__construct(
            sprintf('Некорректный запрос: %s', $message),
            ExceptionCode::BAD_REQUEST,
            $previous
        );
        $this->validationErrors = $validationErrors;
    }

    public function getValidationErrors(): ?array {
        return $this->validationErrors;
    }
}
