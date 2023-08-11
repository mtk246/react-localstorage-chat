<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimDemographicInformation;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ClaimDemographicInformation $resource */
final class DemographicInformationResource extends JsonResource
{
    public function __construct($resource, protected int $type)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $commonFields = [
            'validate' => $this->resource->validate,
            'automatic_eligibility' => $this->resource->automatic_eligibility,
            'company_id' => $this->resource->company_id,
            'bill_classification' => $this->resource->bill_classification,
            'company' => $this->resource->company->name ?? '',
            'facility_id' => $this->resource->facility_id,
            'facility' => $this->resource->facility->name ?? '',
            'patient_id' => $this->resource->patient_id,
            'avatar' => $this->resource->patient?->profile?->avatar,
            'patient' => isset($this->resource->patient->user)
                ? ($this->resource->patient->user->profile->first_name.' '.$this->resource->patient->user->profile->last_name)
                : '',
            'prior_authorization_number' => $this->resource->prior_authorization_number,
            'accept_assignment' => $this->resource->accept_assignment,
            'patient_signature' => $this->resource->patient_signature,
            'insured_signature' => $this->resource->insured_signature,
            'outside_lab' => $this->resource->outside_lab,
            'charges' => $this->resource->charges,
            'employment_related_condition' => $this->resource->employment_related_condition,
            'auto_accident_related_condition' => $this->resource->auto_accident_related_condition,
            'auto_accident_place_state' => $this->resource->auto_accident_place_state,
            'other_accident_related_condition' => $this->resource->other_accident_related_condition,
            'health_professional_qualifier' => $this->resource->healthProfessionals
                ->map(function ($model) {
                    return new ClaimHealthProfessionalResource($model->pivot);
                }),
        ];

        $specificFields = match ($this->type) {
            ClaimType::INSTITUTIONAL->value => [
                'type_of_medical_assistance' => $this->resource->type_of_medical_assistance,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }
}
