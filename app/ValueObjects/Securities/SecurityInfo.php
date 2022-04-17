<?php

declare(strict_types=1);

namespace App\ValueObjects\Securities;

use App\ValueObjects\PositiveFloat;
use App\ValueObjects\PositiveInteger;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SecurityInfo
{
    public function __construct(
        private UuidInterface  $tickerId,
        private PositiveFloat   $pricePurchase,
        private PositiveInteger $numberStocks,
        private Carbon          $purchaseDate
    )
    {
    }

    public function getTickerId(): UuidInterface
    {
        return $this->tickerId;
    }

    public function getPricePurchase(): PositiveFloat
    {
        return $this->pricePurchase;
    }

    public function getNumberStocks(): PositiveInteger
    {
        return $this->numberStocks;
    }

    public function getPurchaseDate(): Carbon
    {
        return $this->purchaseDate;
    }
}
