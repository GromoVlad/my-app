<?php

namespace App\Services\Currency;

use App\Repository\Currency\CurrencyRepository;

class CurrencyService
{
    public function __invoke(): void
    {
        /** @var CurrencyRepository $repo */
        $repo = app(CurrencyRepository::class);
        $dto = $repo->getCurrentExchangeRate();
        $repo->updateCurrencyRates($dto);
    }
}

