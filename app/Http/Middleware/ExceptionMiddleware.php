<?php

namespace App\Http\Middleware;

use App\Enums\ResponseCode;
use App\Exceptions\BadRequestException;
use App\Http\Resources\ErrorResource;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($response->exception instanceof BadRequestException) {
            $resource = new ErrorResource(
                $response->exception->getMessage(),
                $response->exception->getValidationErrors()
            );
            return $resource->setStatusCode(ResponseCode::BAD_REQUEST);
        }
        if ($response->exception instanceof UnauthorizedException) {
            $resource = new ErrorResource($response->exception->getMessage());
            return $resource->setStatusCode(ResponseCode::UNAUTHORIZED);
        }
        if ($response->exception instanceof NotFoundHttpException) {
            $resource = new ErrorResource('Ресурс не найден', ['error' => '404 Not Found']);
            return $resource->setStatusCode(ResponseCode::NOT_FOUND);
        }
        return $response;
    }
}
