<?php

declare(strict_types=1);

namespace App\ValueObjects\Securities;

use App\Enums\FilterCondition;
use App\ValueObjects\NotEmptyString;
use App\ValueObjects\PositiveFloat;

class FilterPrice
{
    public function __construct(
        private NotEmptyString $name,
        private FilterCondition $operator,
        private PositiveFloat $value
    ) {
    }

    public function getName(): NotEmptyString
    {
        return $this->name;
    }

    public function getOperator(): FilterCondition
    {
        return $this->operator;
    }

    public function getValue(): PositiveFloat
    {
        return $this->value;
    }
}
