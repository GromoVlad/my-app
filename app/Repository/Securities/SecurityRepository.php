<?php

declare(strict_types=1);

namespace App\Repository\Securities;

use App\Dto\Securities\FilterSecurityDto;
use App\Dto\Securities\StoreSecurityDto;
use App\Models\Currency;
use App\Models\Security;
use App\Models\Ticker;
use App\ValueObjects\Securities\FilterDate;
use App\ValueObjects\Securities\FilterPrice;
use App\ValueObjects\Securities\SecurityInfo;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SecurityRepository
{

    public function list(FilterSecurityDto $dto)
    {
        $nameTickerTable = (new Ticker())->getTable();
        $nameCurrencyTable = (new Currency())->getTable();
        $nameSecurityTable = (new Security())->getTable();

        $tickerIds = $dto->getTickerCollection()->map(fn($value) => (string)$value)->toArray();
        $currencyIds = $dto->getCurrencyCollection()->map(fn($value) => (string)$value)->toArray();

        $query = Security::leftJoin(
            $nameTickerTable,
            $nameTickerTable . '.ticker_id',
            '=',
            $nameSecurityTable . '.security_ticker_id'
        )->leftJoin(
            $nameCurrencyTable,
            $nameCurrencyTable . '.currency_id',
            '=',
            $nameTickerTable . '.ticker_currency_id'
        )->where('security_user_id', $dto->getUserId());
        if (!empty($tickerIds)) {
            $query->whereIn('ticker_id', $tickerIds);
        }
        if (!empty($currencyIds)) {
            $query->whereIn('currency_id', $currencyIds);
        }
        /** @var FilterDate $date */
        foreach ($dto->getDateCollection()->toArray() as $date) {
            if ($date->getName()->getValue() === 'purchaseDate') {
                $query->where(
                    'security_purchase_date',
                    $date->getOperator()->getValue(),
                    $date->getValue()->format('Y-m-d')
                );
            }
        }
        $query->select(
            'security_ticker_id',
            'ticker_symbol',
            'ticker_name',
            'ticker_actual_price',
            'currency_name',
            'currency_code',
            'currency_symbol',
            'currency_value',
            DB::raw('SUM(security_price_purchase) as total_security_price_purchase'),
            DB::raw('SUM(security_number_stocks) as total_security_number_stocks'),
            DB::raw('SUM(security_price_purchase)/SUM(security_number_stocks) as average_security_price_purchase'),
            DB::raw('ticker_actual_price*SUM(security_number_stocks) as total_actual_price'),
        );
        $query->groupBy(
            'security_ticker_id',
            'ticker_symbol',
            'ticker_name',
            'ticker_actual_price',
            'currency_name',
            'currency_code',
            'currency_symbol',
            'currency_value',
        );
        /** @var FilterPrice $price */
        foreach ($dto->getPriceCollection()->toArray() as $price) {
            if ($price->getName()->getValue() === 'totalPrice') {
                $query->having(
                    DB::raw('SUM(security_price_purchase)'),
                    $price->getOperator()->getValue(),
                    $price->getValue()->getValue()
                );
            }
        }

        $result = $query->get();
        dd($result);
    }

    public function store(StoreSecurityDto $dto): bool
    {
        $prepareDataToStore = $dto->getSecurityInfoCollections()->map(function (SecurityInfo $securityInfo) use ($dto) {
            return [
                "security_id" => (string)Uuid::uuid4(),
                "security_user_id" => $dto->getUserId(),
                "security_ticker_id" => (string)$securityInfo->getTickerId(),
                "security_price_purchase" => $securityInfo->getPricePurchase()->getValue(),
                "security_number_stocks" => $securityInfo->getNumberStocks()->getValue(),
                "security_purchase_date" => $securityInfo->getPurchaseDate()->toDate()->format('Y-m-d'),
                "security_created_at" => date_create()->format('Y-m-d H:i:s')
            ];
        })->toArray();
        return Security::insert($prepareDataToStore);
    }
}
