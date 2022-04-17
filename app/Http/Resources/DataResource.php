<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class DataResource extends JsonResource
{
    private ?array $data;
    private bool $success;

    #[Pure]
    public function __construct(array $data = null, bool $success = true)
    {
        parent::__construct(null);
        $this->data = $data;
        $this->success = $success;
    }

    #[ArrayShape(['data' => "array|null", 'success' => "bool"])]
    public function toArray($request): array
    {
        return [
            'data' => $this->data,
            'success' => $this->success,
        ];
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setStatusCode(int $responseCode): JsonResponse
    {
        return $this->response()->setStatusCode($responseCode);
    }
}
