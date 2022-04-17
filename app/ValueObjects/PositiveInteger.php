<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Exceptions\InvariantViolationException;

class PositiveInteger
{
    private int $value;

    /**
     * @throws InvariantViolationException
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvariantViolationException('Строка не может быть пустой');
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
