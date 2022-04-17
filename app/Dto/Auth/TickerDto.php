<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use App\Enums\CurrencyCode;

class TickerDto
{
    public function __construct(
        private string       $symbol,
        private string       $name,
        private int          $lotSize,
        private float        $actualPrice,
        private CurrencyCode $currencyCode,
    )
    {
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLotSize(): int
    {
        return $this->lotSize;
    }

    public function getActualPrice(): float
    {
        return $this->actualPrice;
    }

    public function getCurrencyCode(): CurrencyCode
    {
        return $this->currencyCode;
    }
}
