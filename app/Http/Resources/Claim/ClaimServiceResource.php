<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimServiceResource extends JsonResource
{
    public function __construct(
        $resource,
        protected int $type,
        protected ?int $company_id
    ) {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'diagnoses' => $this->resource->diagnoses->map(function ($model) {
                return new DiagnosesResource($model, $this->type);
            }),
            'services' => $this->resource->services->map(function ($model) {
                return new ServiceResource($model, $this->type, $this->company_id);
            }),
        ];
    }
}
