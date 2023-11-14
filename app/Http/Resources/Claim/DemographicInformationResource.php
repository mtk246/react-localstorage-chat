<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Models\Claims\ClaimDemographicInformation;
use App\Models\CompanyPatient;
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
        $companyPatient = CompanyPatient::with(['patient', 'company', 'billingCompany'])
        ->find($this->patient_id);

        $commonFields = [
            'validate' => $this->resource->validate,
            'automatic_eligibility' => $this->resource->automatic_eligibility,
            'company_id' => isset($this->resource->split_company_type)
                ? $this->resource->company_id.'-'.$this->resource->split_company_type->value
                : $this->resource->company_id,
            'bill_classification' => $this->resource->bill_classification,
            'company' => $this->resource->company->name ?? '',
            'facility_id' => $this->resource->facility_id,
            'facility' => $this->resource->facility->name ?? '',
            'patient_id' => $this->resource->patient_id,
            'avatar' => $this->resource->patient?->profile?->avatar,
            'patient' => isset($this->resource->patient->profile)
                ? ($this->resource->patient->profile->first_name.' '.$this->resource->patient->profile->last_name)
                : '',
            'patient_profile_info_arr' => isset($this->resource->patient) && isset($this->resource->patient->profile)
                ? array_merge([
                    'patient_id' => $this->resource->patient_id,
                    'med_num' => $companyPatient?->med_num ?? '',
                    'patient_code' => $this->resource->patient->code,
                    'patient_address' => $this->resource->patient->mainAddress,
                ], $this->resource->patient->profile->toArray())
                : [],
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
