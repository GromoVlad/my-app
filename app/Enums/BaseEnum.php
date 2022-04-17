<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use WrongEnumException;

abstract class BaseEnum extends Enum
{
    private mixed $value;

    public function __construct($value)
    {
        if (!self::contains($value)) {
            throw new WrongEnumException(get_called_class(), $value);
        }
        $this->value = $value;
    }

    /**
     * @return Collection<BaseEnum>
     */
    public static function allAsEnums(): Collection
    {
        return collect(static::all())->map(function ($value) {
            return new static($value);
        });
    }

    #[Pure] public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function getValue()
    {
        return $this->value;
    }
}
