<?php

declare(strict_types=1);

namespace App\Services\Securities;

use App\Dto\Securities\StoreSecurityDto;
use App\Repository\Securities\SecurityRepository;

class StoreSecurityService
{
    public function __construct(private SecurityRepository $securityRepository)
    {
    }

    public function store(StoreSecurityDto $dto): bool
    {
        return $this->securityRepository->store($dto);
    }
}
