<?php

declare(strict_types=1);

namespace App\Services\Securities;

use App\Dto\Securities\FilterSecurityDto;
use App\Repository\Securities\SecurityRepository;

class ListSecurityService
{
    public function __construct(private SecurityRepository $securityRepository)
    {
    }

    public function list(FilterSecurityDto $dto)
    {
        $this->securityRepository->list($dto);
    }
}
