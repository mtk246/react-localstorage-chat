<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Http\Resources\Json\JsonResource;

final class ServiceResource extends JsonResource
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
        $medication = $this->resource->procedure?->companyServices
            ->firstWhere('company_id', $this->company_id)?->medication ?? null;

        $commonFields = [
            'id' => $this->resource->id,
            'from_service' => $this->resource->from_service,
            'to_service' => $this->resource->to_service,
            'procedure_id' => $this->resource->procedure_id,
            'procedures' => isset($this->resource->procedure_id)
                ? [
                    [
                        'id' => $this->resource->procedure_id,
                        'name' => $this->resource->procedure->code,
                        'description' => $this->resource->procedure->description,
                        'price' => $this->resource->procedure->companyServices
                            ->firstWhere(
                                'company_id',
                                $this->company_id
                            )
                            ?->price ?? 0,
                        'units_limit' => $medication?->units_limit ? (int) $medication?->units_limit : null,
                        'is_medication' => isset($medication),
                    ],
                ]
                : [],
            'units_limit' => $medication?->units_limit ? (int) $medication?->units_limit : null,
            'price' => $this->resource->price,
            'days_or_units' => $this->resource->days_or_units,
            'copay' => $this->resource->copay,
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'revenue_code_id' => (int) $this->resource->revenue_code_id ?? '',
                'revenue_codes' => isset($this->resource->revenueCode)
                    ? [
                        [
                            'id' => (int) $this->resource->revenue_code_id,
                            'name' => $this->resource->revenueCode->code,
                            'description' => $this->resource->revenueCode->description,
                        ],
                    ]
                    : [],
                'total_charge' => $this->resource->total_charge,
            ],
            ClaimType::PROFESSIONAL->value => [
                'modifier_ids' => $this->resource->modifier_ids,
                'modifiers' => $this->resource->modifiers,
                'place_of_service_id' => (int) $this->resource->place_of_service_id,
                'type_of_service_id' => (int) $this->resource->type_of_service_id,
                'diagnostic_pointers' => $this->resource->diagnostic_pointers,
                'emg' => (bool) $this->resource->emg,
                'epsdt_id' => (int) $this->resource->epsdt_id,
                'family_planning_id' => (int) $this->resource->family_planning_id,
            ],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
