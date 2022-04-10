<?php

namespace App\Repository\Currency;

use App\Dto\Currency\CurrencyDto;
use App\Enums\CurrencyCode;
use App\Models\Currency;
use GuzzleHttp\Client;
use SimpleXMLElement;

class CurrencyRepository
{
    const MOEX_CURRENCY_RATES_URI = "https://iss.moex.com/iss/statistics/engines/currency/markets/selt/rates.xml";
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function updateCurrencyRates(CurrencyDto $dto): void
    {
        Currency::where('currency_code', CurrencyCode::USD)->update(['currency_value' => $dto->getUsd()]);
        Currency::where('currency_code', CurrencyCode::EUR)->update(['currency_value' => $dto->getEur()]);
    }

    public function getCurrentExchangeRate(): CurrencyDto
    {
        $response = $this->client->request('GET', self::MOEX_CURRENCY_RATES_URI);
        $contents = $response->getBody()->getContents();
        $currencies = (new SimpleXMLElement($contents))->data->rows->row->attributes();
        $usd = (float)$currencies->CBRF_USD_LAST;
        $eur = (float)$currencies->CBRF_EUR_LAST;
        return new CurrencyDto($usd, $eur);
    }
}
