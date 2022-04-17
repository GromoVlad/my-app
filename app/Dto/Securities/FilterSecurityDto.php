<?php

declare(strict_types=1);

namespace App\Dto\Securities;

use App\ValueObjects\Securities\FilterDate;
use App\ValueObjects\Securities\FilterPrice;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

class FilterSecurityDto
{
    public function __construct(
        private int $userId,
        private Collection $tickerCollection,
        private Collection $currencyCollection,
        private Collection $dateCollection,
        private Collection $priceCollection
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return Collection<UuidInterface>
     */
    public function getTickerCollection(): Collection
    {
        return $this->tickerCollection;
    }

    /**
     * @return Collection<UuidInterface>
     */
    public function getCurrencyCollection(): Collection
    {
        return $this->currencyCollection;
    }

    /**
     * @return Collection<FilterDate>
     */
    public function getDateCollection(): Collection
    {
        return $this->dateCollection;
    }

    /**
     * @return Collection<FilterPrice>
     */
    public function getPriceCollection(): Collection
    {
        return $this->priceCollection;
    }
}
