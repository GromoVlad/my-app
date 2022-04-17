<?php

declare(strict_types=1);

namespace App\Services\Markets;

use App\Repository\Markets\RussianMarketRepository;
use GuzzleHttp\Exception\GuzzleException;

class RussianMarketService
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(): void
    {
        /** @var RussianMarketRepository $repo */
        $repo = app(RussianMarketRepository::class);
        $dtos = $repo->getMoexRussianMarkets();
        $repo->insertOrUpdateTickers($dtos);
    }
}

