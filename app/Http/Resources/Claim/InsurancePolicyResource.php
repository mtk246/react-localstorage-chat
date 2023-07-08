<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use Illuminate\Http\Resources\Json\JsonResource;

final class InsurancePolicyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'insurance_policy_id' => $this->resource->pivot->insurance_policy_id,
            'order' => $this->resource->pivot->order,
        ];
    }
}
