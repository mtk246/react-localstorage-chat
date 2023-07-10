<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Http\Resources\Json\JsonResource;

final class DiagnosesResource extends JsonResource
{
    public function __construct($resource, protected int $type)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $commonFields = [
            'item' => $this->resource->pivot->item,
            'diagnosis_id' => $this->resource->id,
            'code' => $this->resource->code,
            'description' => $this->resource->description,
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'admission' => $this->resource->pivot->admission,
                'poa' => $this->resource->pivot->poa,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
