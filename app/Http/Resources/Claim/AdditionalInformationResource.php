<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Http\Resources\Json\JsonResource;

final class AdditionalInformationResource extends JsonResource
{
    public function __construct(
        $resource,
        protected int $type,
        protected $service,
    ) {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $commonFields = [
            'from' => $this->service->from,
            'to' => $this->service->to,
            'claim_date_informations' => $this->resource->dateInformations->map(function ($model) {
                return new ClaimDateInformationResource($model, $this->type);
            }),
            'extra_information' => $this->resource->adiditional_information,
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'diagnosis_related_group_id' => (int) $this->service->diagnosis_related_group_id,
                'non_covered_charges' => $this->service->non_covered_charges,
                'patient_information' => new PatientInformationResource($this->resource->patientInformation),
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
