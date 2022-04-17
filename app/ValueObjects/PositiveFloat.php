<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Exceptions\InvariantViolationException;

class PositiveFloat
{
    private float $value;

    /**
     * @throws InvariantViolationException
     */
    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new InvariantViolationException('Строка не может быть пустой');
        }
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
