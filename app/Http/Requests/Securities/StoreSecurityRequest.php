<?php

declare(strict_types=1);

namespace App\Http\Requests\Securities;

use App\Dto\Securities\StoreSecurityDto;
use App\Exceptions\InvariantViolationException;
use App\Http\Requests\BaseRequest;
use App\ValueObjects\PositiveFloat;
use App\ValueObjects\PositiveInteger;
use App\ValueObjects\Securities\SecurityInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;
use Ramsey\Uuid\Uuid;

class StoreSecurityRequest extends BaseRequest
{
    #[ArrayShape(['*.tickerId' => "string", '*.pricePurchase' => "string", '*.numberStocks' => "string", '*.purchaseDate' => "string"])]
    public function rules(): array
    {
        return [
            '*.tickerId' => 'required|uuid|exists:App\Models\Ticker,ticker_id',
            '*.pricePurchase' => 'required|numeric|min:0',
            '*.numberStocks' => 'required|integer|min:0',
            '*.purchaseDate' => 'required|date|date_format:Y-m-d',
        ];
    }

    /**
     * @throws InvariantViolationException
     */
    public function toDTO(): StoreSecurityDto
    {
        $collection = collect();
        foreach ($this->all() as $item) {
            $collection->push(
                new SecurityInfo(
                    Uuid::fromString($item['tickerId']),
                    new PositiveFloat($item['pricePurchase']),
                    new PositiveInteger($item['numberStocks']),
                    new Carbon($item['purchaseDate'])
                )
            );
        }
        return new StoreSecurityDto($collection, Auth::user()->id);
    }
}
