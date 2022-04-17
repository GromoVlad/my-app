<?php

namespace App\Repository\Markets;

use App\Dto\Auth\TickerDto;
use App\Enums\CurrencyCode;
use App\Models\Currency;
use App\Models\Ticker;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use SimpleXMLElement;

class RussianMarketRepository
{
    const MOEX_RUSSIAN_MARKETS_URI = "https://iss.moex.com/iss/engines/stock/markets/shares/boards/TQBR/securities.xml?iss.meta=off&iss.only=securities&securities.columns=SECID,PREVADMITTEDQUOTE,CURRENCYID,LOTSIZE,SECNAME,SHORTNAME";
    const FLOAT_ZERO = 0.000;

    public function __construct(private Client $client)
    {
    }

    /**
     * @return Collection<TickerDto>
     *
     * @throws GuzzleException
     * @throws Exception
     */
    public function getMoexRussianMarkets(): Collection
    {
        $dtos = collect();
        $response = $this->client->request('GET', self::MOEX_RUSSIAN_MARKETS_URI);
        $contents = $response->getBody()->getContents();
        $russianMarkets = (new SimpleXMLElement($contents))->data->rows->row;
        foreach ($russianMarkets as $element) {
            $actualPrice = (float)$element->attributes()->PREVADMITTEDQUOTE;
            if ($actualPrice !== self::FLOAT_ZERO) {
                $dtos->push(
                    new TickerDto(
                        (string)$element->attributes()->SECID,
                        (string)$element->attributes()->SECNAME,
                        (int)$element->attributes()->LOTSIZE,
                        $actualPrice,
                        new CurrencyCode((string)$element->attributes()->CURRENCYID),
                    )
                );
            }
        }
        return $dtos;
    }

    public function insertOrUpdateTickers(Collection $dtos): void
    {
        $addedTickers = [];
        $updatedTickers = '';
        foreach ($dtos as $dto) {
            $currencyId = Currency::where('currency_code', $dto->getCurrencyCode())->first()->currency_id;
            $tickerExist = Ticker::where('ticker_symbol', $dto->getSymbol())->first();
            if ($tickerExist) {
                $updatedAt = (string)now();
                $updatedTickers .= "UPDATE stock_market.tickers SET ticker_lot_size = " . $dto->getLotSize() .
                    ", ticker_actual_price = " . $dto->getActualPrice() . ", ticker_updated_at = '" . $updatedAt
                    . "' WHERE ticker_id = '" . $tickerExist->ticker_id . "';";
            } else {
                $addedTickers[] = [
                    'ticker_id' => Uuid::uuid4(),
                    'ticker_symbol' => $dto->getSymbol(),
                    'ticker_name' => $dto->getName(),
                    'ticker_lot_size' => $dto->getLotSize(),
                    'ticker_actual_price' => $dto->getActualPrice(),
                    'ticker_currency_id' => $currencyId,
                    'ticker_created_at' => date_create(),
                ];
            }
        }
        Ticker::insert($addedTickers);
        if (mb_strlen($updatedTickers) > 0){
            DB::unprepared($updatedTickers);
        }
    }
}
