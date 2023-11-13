<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimHealthProfessionalResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'field_id' => $this->resource->field_id,
            'health_professional_id' => $this->resource->health_professional_id,
            'qualifier_id' => $this->resource->qualifier_id,
        ];
    }
}
