<?php

namespace App\Dto\Currency;

use App\Enums\CurrencyCode;
use JetBrains\PhpStorm\ArrayShape;

class CurrencyDto
{
    private float $usd;
    private float $eur;

    public function __construct(float $usd, float $eur)
    {
        $this->usd = $usd;
        $this->eur = $eur;
    }

    public function getUsd(): float
    {
        return $this->usd;
    }

    public function getEur(): float
    {
        return $this->eur;
    }

    #[ArrayShape([CurrencyCode::USD => "float", CurrencyCode::EUR => "float"])]
    public function toArray(): array
    {
        return [CurrencyCode::USD => $this->usd, CurrencyCode::EUR => $this->eur];
    }
}
