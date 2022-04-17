<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Exceptions\InvariantViolationException;
use JetBrains\PhpStorm\Pure;

class NotEmptyString
{
     private string $value;

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

    #[Pure]
    public function __toString(): string
    {
        return $this->getValue();
    }
}
