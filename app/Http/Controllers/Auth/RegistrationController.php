<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Exceptions\AlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\DataResource;
use App\Http\Resources\ErrorResource;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->registerService->register($request->toDTO());
            return (new DataResource([
                'name' => $request->toDTO()->getName(),
                'email' => $request->toDTO()->getEmail()
            ]))->setStatusCode(ResponseCode::CREATED);
        } catch (AlreadyExistsException $e) {
            return (new ErrorResource($e->getMessage()))
                ->setStatusCode(ResponseCode::NOT_FOUND);
        }
    }
}
