<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FieldInformationInstitutional;
use App\Enums\Claim\FieldInformationProfessional;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

final class ClaimBodyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'billing_company_id' => $this->resource->id,
            'code' => $this->resource->code,
            'type' => $this->resource->type->value,
            'submitter_name' => $this->resource->submitter_name,
            'submitter_contact' => $this->resource->submitter_contact,
            'submitter_phone' => $this->resource->submitter_phone,
            'demographic_information' => $this->getDemographicInformation(
                $this->resource->demographicInformation,
                $this->resource->type->value
            ),
            'claim_service' => $this->getClaimService(
                $this->resource->service,
                $this->resource->type->value
            ),
            'additional_information' => $this->getAdditionalInformation($this->resource->type->value),
            'insurance_policies' => $this->getInsurancePolicies(),

            /*
             * @todo Pendiente por validar
             *'last_modified' => $this->getLastModifiedAttribute(),
             *'private_note' => $this->getPrivateNoteAttribute(),
             *'status' => $this->getStatusAttribute(),
             *'status_history' => $this->getStatusHistoryAttribute(),
             *'notes_history' => $this->getNotesHistoryAttribute(),
             *'billed_amount' => $this->getBilledAmountAttribute(),
             *'amount_paid' => $this->getAmountPaidAttribute(),
             *'past_due_date' => $this->getPastDueDateAttribute(),
             *'date_of_service' => $this->getDateOfServiceAttribute(),
             *'status_date' => $this->getStatusDateAttribute(),
             *'insurance_company_id' => $this->getInsuranceCompanyIdAttribute(),
             *'insurance_company' => $this->getInsuranceCompanyAttribute(),
             *'insurance_plan' => $this->getInsurancePlanAttribute(),
             *'user_created' => $this->getUserCreatedAttribute(),
             *'type_responsibility' => $this->insurancePolicies()->first()?->typeResponsibility ?? null,
             */

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }

    private function getDemographicInformation(object $data, int $type): array
    {
        $commonFields = [
            'validate' => $data->validate,
            'automatic_eligibility' => $data->automatic_eligibility,
            'company_id' => $data->company_id,
            'company' => $data->company->name ?? '',
            'facility_id' => $data->facility_id,
            'facility' => $data->facility->name ?? '',
            'patient_id' => $data->patient_id,
            'patient' => isset($data->patient->user)
                ? ($data->patient->user->profile->first_name.' '.$data->patient->user->profile->last_name)
                : '',
            'prior_authorization_number' => $data->prior_authorization_number,
            'accept_assignment' => $data->accept_assignment,
            'patient_signature' => $data->patient_signature,
            'insured_signature' => $data->insured_signature,
            'outside_lab' => $data->outside_lab,
            'charges' => $data->charges,
            'employment_related_condition' => $data->employment_related_condition,
            'auto_accident_related_condition' => $data->auto_accident_related_condition,
            'auto_accident_place_state' => $data->auto_accident_place_state,
            'other_accident_related_condition' => $data->other_accident_related_condition,
            'health_professional_qualifier' => $data->healthProfessionals
                ->map(function ($model) {
                    return new ClaimHealthProfessionalResource($model->pivot);
                }),
        ];

        $specificFields = match ($type) {
            ClaimType::INSTITUTIONAL->value => [
                'type_of_medical_assistance' => $this->resource->type->value_of_medical_assistance,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }

    private function getClaimService(object $data, int $type): array
    {
        $commonFields = [
            'diagnoses' => $this->getDiagnoses($type),
            'services' => $this->getServices($type),
        ];

        $specificFields = match ($type) {
            ClaimType::INSTITUTIONAL->value => [
                'diagnosis_related_group_id' => $data->diagnosis_related_group_id,
                'non_covered_charges' => $data->non_covered_charges,
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }

    private function getDiagnoses(int $type): Collection
    {
        return $this->resource->service->diagnoses
            ->map(function ($model) use ($type) {
                $commonFields = [
                    'id' => $model->pivot->id,
                    'item' => $model->pivot->item,
                    'diagnosis_id' => $model->pivot->diagnosis_id,
                ];

                $specificFields = match ($type) {
                    ClaimType::INSTITUTIONAL->value => [
                        'admission' => $model->pivot->admission,
                        'poa' => $model->pivot->poa,
                    ],
                    ClaimType::PROFESSIONAL->value => [],
                    default => throw new \InvalidArgumentException('Invalid format type'),
                };

                return array_merge($commonFields, $specificFields);
            });
    }

    private function getServices(int $type): Collection
    {
        return $this->resource->service->services
            ->map(function ($model) use ($type) {
                $commonFields = [
                    'id' => $model->id,
                    'from_service' => $model->from_service,
                    'to_service' => $model->to_service,
                    'procedure_id' => $model->procedure_id,
                    'procedures' => isset($model->procedure_id)
                        ? [
                            [
                                'id' => $model->procedure_id,
                                'name' => $model->procedure->code,
                                'description' => $model->procedure->description,
                                'price' => $model->procedure->companies
                                    ->firstWhere(
                                        'company_id',
                                        $this
                                            ->resource
                                            ->demographicInformation
                                            ->company_id
                                    )
                                    ?->pivot
                                    ?->price ?? 0,
                            ],
                        ]
                        : [],
                    'price' => $model->price,
                    'days_or_units' => $model->days_or_units,
                    'copay' => $model->copay,
                ];

                $specificFields = match ($type) {
                    ClaimType::INSTITUTIONAL->value => [
                        'revenue_code_id' => $model->revenue_code_id,
                        'revenue_codes' => isset($model->revenueCode)
                            ? [
                                [
                                    'id' => $model->revenue_code_id,
                                    'name' => $model->revenueCode->code,
                                    'description' => $model->revenueCode->description,
                                ],
                            ]
                            : [],
                        'total_charge' => $model->total_charge,
                    ],
                    ClaimType::PROFESSIONAL->value => [
                        'modifier_ids' => $model->modifier_ids,
                        'place_of_service_id' => $model->place_of_service_id,
                        'type_of_service_id' => $model->type_of_service_id,
                        'diagnostic_pointers' => $model->diagnostic_pointers,
                        'emg' => $model->emg,
                        'epsdt_id' => $model->epsdt_id,
                        'family_planning_id' => $model->family_planning_id,
                    ],
                    default => throw new \InvalidArgumentException('Invalid format type'),
                };

                return array_merge($commonFields, $specificFields);
            });
    }

    private function getAdditionalInformation(int $type): array
    {
        $commonFields = [
            'claim_date_informations' => $this->getClaimDateInformations($type),
            'extra_information' => $this->resource->adiditional_information,
        ];

        $specificFields = match ($type) {
            ClaimType::INSTITUTIONAL->value => [
                'patient_information' => PatientInformationResource::collection($this->resource->patientInformation),
            ],
            ClaimType::PROFESSIONAL->value => [],
            default => throw new \InvalidArgumentException('Invalid format type'),
        };

        return array_merge($commonFields, $specificFields);
    }

    private function getClaimDateInformations(int $type): Collection
    {
        return $this->resource->dateInformations
            ->map(function ($model) use ($type) {
                $commonFields = [
                    'id' => $model->id,
                    'field_id' => $model->field_id,
                    'field' => match ($model->field_id) {
                        FieldInformationInstitutional::FIELD_31->value => FieldInformationInstitutional::FIELD_31->getName(),
                        FieldInformationInstitutional::FIELD_32->value => FieldInformationInstitutional::FIELD_32->getName(),
                        FieldInformationInstitutional::FIELD_33->value => FieldInformationInstitutional::FIELD_33->getName(),
                        FieldInformationInstitutional::FIELD_34->value => FieldInformationInstitutional::FIELD_34->getName(),
                        FieldInformationInstitutional::FIELD_35->value => FieldInformationInstitutional::FIELD_35->getName(),
                        FieldInformationInstitutional::FIELD_36->value => FieldInformationInstitutional::FIELD_36->getName(),
                        FieldInformationProfessional::FIELD_14->value => FieldInformationProfessional::FIELD_14->getName(),
                        FieldInformationProfessional::FIELD_15->value => FieldInformationProfessional::FIELD_15->getName(),
                        FieldInformationProfessional::FIELD_16->value => FieldInformationProfessional::FIELD_16->getName(),
                        FieldInformationProfessional::FIELD_18->value => FieldInformationProfessional::FIELD_18->getName(),
                        FieldInformationProfessional::FIELD_19->value => FieldInformationProfessional::FIELD_19->getName(),
                        default => '',
                    },
                    'qualifier_id' => $model->qualifier_id,
                    'qualifier' => $model->qualifier?->code,
                    'from_date' => $model->from_date,
                    'to_date' => $model->to_date,
                    'description' => $model->description,
                ];

                $specificFields = match ($type) {
                    ClaimType::INSTITUTIONAL->value => [
                        'amount' => $model->amount,
                    ],
                    ClaimType::PROFESSIONAL->value => [],
                    default => throw new \InvalidArgumentException('Invalid format type'),
                };

                return array_merge($commonFields, $specificFields);
            });
    }

    private function getInsurancePolicies(): Collection
    {
        return $this->resource->insurancePolicies
            ->map(function ($model) {
                return [
                    'id' => $model->pivot->id,
                    'insurance_policy_id' => $model->pivot->insurance_policy_id,
                    'order' => $model->pivot->order,
                ];
            });
    }
}
