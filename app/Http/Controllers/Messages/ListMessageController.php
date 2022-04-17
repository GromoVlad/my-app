<?php

declare(strict_types=1);

namespace App\Http\Controllers\Messages;

use App\Dto\Auth\TickerDto;
use App\Enums\CurrencyCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Securities\StoreSecurityRequest;
use App\Models\Currency;
use App\Models\Ticker;
use App\Services\Markets\RussianMarketService;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Ramsey\Uuid\Uuid;
use SimpleXMLElement;

class ListMessageController extends Controller
{
    public function __construct(private RussianMarketService $serv)
    {
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function list(StoreSecurityRequest $request)
    {
        $this->serv->__invoke();
    }
}
