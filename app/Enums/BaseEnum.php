<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Enum;

abstract class BaseEnum extends Enum
{
    /**
     * @return Collection<BaseEnum>
     */
    public static function allAsEnums(): Collection
    {
        return collect(static::all())->map(function ($value) {
            return new static($value);
        });
    }

    public function __toString(): string
    {
        return (string)$this->getValue();
    }
}
