<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    protected $errors;
    protected $message;
    protected $total;

    public function __construct(string $message, array $errors = null)
    {
        parent::__construct(null);
        $this->message = $message;
        $this->errors = $errors;
    }

    public function setStatusCode(int $responseCode): JsonResponse
    {
        return $this->response()->setStatusCode($responseCode);
    }

    /**
     * Выводит полученные данные в массиве
     *
     * @param mixed $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [];
    }

    /**
     * Объединяет данные
     *
     * @param mixed $request
     *
     * @return array
     */
    public function with($request)
    {
        return [
            'errors' => $this->errors,
            'message' => $this->message,
            'success' => false
        ];
    }
}
