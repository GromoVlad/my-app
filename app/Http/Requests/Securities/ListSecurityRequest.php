<?php

declare(strict_types=1);

namespace App\Http\Requests\Securities;

use App\Dto\Securities\FilterSecurityDto;
use App\Enums\FilterCondition;
use App\Exceptions\InvariantViolationException;
use App\Http\Requests\BaseRequest;
use App\ValueObjects\NotEmptyString;
use App\ValueObjects\PositiveFloat;
use App\ValueObjects\Securities\FilterDate;
use App\ValueObjects\Securities\FilterPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use WrongEnumException;

class ListSecurityRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'filters.tickers.*.tickerId' => 'required|uuid|exists:App\Models\Ticker,ticker_id',
            'filters.currencies.*.currencyId' => 'required|uuid|exists:App\Models\Currency,currency_id',
            'filters.date.*.name' => 'required|string|in:purchaseDate',
            'filters.date.*.operator' => 'required|string|in:>,>=,<,<=,=,!=',
            'filters.date.*.value' => 'required|date|date_format:Y-m-d',
            'filters.price.*.name' => 'required|string|in:totalPrice',
            'filters.price.*.operator' => 'required|string|in:>,>=,<,<=,=',
            'filters.price.*.value' => 'required|numeric|min:0',
        ];
    }

    /**
     * @throws InvariantViolationException
     * @throws WrongEnumException
     */
    public function toDTO(): FilterSecurityDto
    {
        $tickers = collect();
        $currencies = collect();
        $date = collect();
        $price = collect();
        $filters = $this->input('filters');
        if (isset($filters['tickers'])) {
            foreach ($filters['tickers'] as $ticker) {
                $tickers->push(Uuid::fromString($ticker['tickerId']));
            }
        }
        if (isset($filters['currencies'])) {
            foreach ($filters['currencies'] as $currency) {
                $currencies->push(Uuid::fromString($currency['currencyId']));
            }
        }
        if (isset($filters['date'])) {
            foreach ($filters['date'] as $item) {
                $date->push(new FilterDate(
                    new NotEmptyString($item['name']),
                    new FilterCondition($item['operator']),
                    new Carbon($item['value'])
                ));
            }
        }
        if (isset($filters['price'])) {
            foreach ($filters['price'] as $item) {
                $price->push(new FilterPrice(
                    new NotEmptyString($item['name']),
                    new FilterCondition($item['operator']),
                    new PositiveFloat((float)$item['value'])
                ));
            }
        }
        return new FilterSecurityDto(Auth::user()->id, $tickers, $currencies, $date, $price);
    }
}
