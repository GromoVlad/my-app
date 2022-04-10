<?php

declare(strict_types=1);

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\ListMessagesRequest;
use App\Models\Currency;
use GuzzleHttp\Client;
use SimpleXMLElement;

class ListMessageController extends Controller
{
    const MOEX_RUSSIAN_MARKETS_URI = "https://iss.moex.com/iss/engines/stock/markets/shares/boards/TQBR/securities.xml?iss.meta=off&iss.only=securities&securities.columns=SECID,PREVADMITTEDQUOTE,CURRENCYID,LOTSIZE,SECNAME,SHORTNAME";

    public function __construct(private Client $client)
    {
    }

    public function list(ListMessagesRequest $request)
    {
        $response = $this->client->request('GET', self::MOEX_RUSSIAN_MARKETS_URI);
        $contents = $response->getBody()->getContents();
        $russaianMarkets = (new SimpleXMLElement($contents))->data->rows->row;
        foreach ($russaianMarkets as $element) {

            dd((string)$element->attributes()->SECID);
        }

  //      "SECID" => "ABRD"
  //  "PREVADMITTEDQUOTE" => "183.5"
  //  "CURRENCYID" => "SUR"
  //  "LOTSIZE" => "10"
  //  "SECNAME" => "Абрау-Дюрсо ПАО ао"
  //  "SHORTNAME" => "АбрауДюрсо"

      //  dd($russaianMarkets);
       // dd(Tickers::first()->securities);
       // dd(Currency::where('currency_code', 'EUR')->first()->tickers);
      //  dd(Security::first()->ticker);
    }

  //  public function updateCurrencyRates(CurrencyDto $dto): void
  //  {
  //      Currency::where('currency_code', CurrencyCode::USD)->update(['currency_value' => $dto->getUsd()]);
  //      Currency::where('currency_code', CurrencyCode::EUR)->update(['currency_value' => $dto->getEur()]);
  //  }
  //  public function getCurrentExchangeRate(): CurrencyDto
  //  {
  //      $response = $this->client->request('GET', self::MOEX_CURRENCY_RATES_URI);
  //      $contents = $response->getBody()->getContents();
  //      $currencies = (new SimpleXMLElement($contents))->data->rows->row->attributes();
  //      $usd = (float)$currencies->CBRF_USD_LAST;
  //      $eur = (float)$currencies->CBRF_EUR_LAST;
  //      return new CurrencyDto($usd, $eur);
  //  }
}
