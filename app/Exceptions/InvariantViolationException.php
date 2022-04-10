<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Exception;
use Throwable;

class InvariantViolationException extends Exception
{
    /**
     * @param string           $message
     * @param Throwable | null $previous
     */
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, ExceptionCode::INVARIANT_VIOLATION, $previous);
    }
}
