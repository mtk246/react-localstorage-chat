<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimServiceResource extends JsonResource
{
    public function __construct(
        $resource,
        protected int $type,
        protected int $company_id
    )
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $commonFields = [
            'diagnoses' => $this->resource->diagnoses->map(function ($model) {
                return new DiagnosesResource($model, $this->type);
            }),
            'services' => $this->resource->services->map(function ($model) {
                return new ServiceResource($model, $this->type, $this->company_id);
            }),
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'diagnosis_related_group_id' => $this->resource->diagnosis_related_group_id,
                'non_covered_charges' => $this->resource->non_covered_charges,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
