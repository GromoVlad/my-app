<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /** @var array */
    private $data;
    /** @var array */
    private $success;

    public function __construct(array $data = null, bool $success = true)
    {
        parent::__construct(null);
        $this->data = $data;
        $this->success = $success;
    }

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
