<?php

declare(strict_types=1);

namespace App\Http\Controllers\Securities;

use App\Enums\ResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Securities\StoreSecurityRequest;
use App\Http\Resources\DataResource;
use App\Http\Resources\ErrorResource;
use App\Services\Securities\StoreSecurityService;
use Illuminate\Http\JsonResponse;
use Throwable;

class StoreSecurityController extends Controller
{
    public function __construct(private StoreSecurityService $storeSecurityService)
    {
    }

    public function store(StoreSecurityRequest $request): JsonResponse
    {
        try {
            $result = $this->storeSecurityService->store($request->toDTO());
            return (new DataResource(['success' => $result]))->setStatusCode(ResponseCode::CREATED);
        } catch (Throwable $e) {
            return (new ErrorResource($e->getMessage()))->setStatusCode(ResponseCode::APPLICATION_ERROR);
        }
    }
}
