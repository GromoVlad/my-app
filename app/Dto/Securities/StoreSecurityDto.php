<?php

declare(strict_types=1);

namespace App\Dto\Securities;

use App\ValueObjects\Securities\SecurityInfo;
use Illuminate\Support\Collection;

class StoreSecurityDto
{
    public function __construct(private Collection $securityInfoCollections, private int $userId)
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return Collection<SecurityInfo>
     */
    public function getSecurityInfoCollections(): Collection
    {
        return $this->securityInfoCollections;
    }
}
