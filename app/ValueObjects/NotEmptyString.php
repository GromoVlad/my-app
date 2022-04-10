<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Exceptions\InvariantViolationException;

class NotEmptyString
{
     private $value;

    /**
     * @throws InvariantViolationException
     */
    public function __construct(string $value)
    {
        $preparedValue = trim($value);
        if (empty($preparedValue)) {
            throw new InvariantViolationException('Строка не может быть пустой');
        }
        $this->value = $preparedValue;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
