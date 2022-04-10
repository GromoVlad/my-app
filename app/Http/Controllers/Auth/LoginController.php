<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\DataResource;
use App\Http\Resources\ErrorResource;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Throwable;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $accessToken = $this->loginService->login($request->toDTO());
            return (new DataResource(['accessToken' => $accessToken]))
                ->setStatusCode(ResponseCode::OK);
        } catch (NotFoundException $e) {
            return (new ErrorResource($e->getMessage()))
                ->setStatusCode(ResponseCode::NOT_FOUND);
        } catch (Throwable $e) {
            return (new ErrorResource($e->getMessage()))
                ->setStatusCode(ResponseCode::APPLICATION_ERROR);
        }
    }
}
