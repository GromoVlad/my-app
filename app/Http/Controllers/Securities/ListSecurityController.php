<?php

declare(strict_types=1);

namespace App\Http\Controllers\Securities;

use App\Exceptions\InvariantViolationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Securities\ListSecurityRequest;
use App\Services\Securities\ListSecurityService;
use WrongEnumException;

class ListSecurityController  extends Controller
{
    public function __construct(private ListSecurityService $listSecurityService)
    {
    }

    /**
     * @throws InvariantViolationException
     * @throws WrongEnumException
     */
    public function list(ListSecurityRequest $request)
    {
        $this->listSecurityService->list($request->toDTO());
    }
}
