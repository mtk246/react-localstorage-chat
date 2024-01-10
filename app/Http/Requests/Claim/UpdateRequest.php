<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\ClaimType;
use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\ArrayCountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class UpdateRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreRequestWrapper::class;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        $demographicField = $this->input('demographic_information');

        return match ($this->input('type')) {
            ClaimType::INSTITUTIONAL->value => $this->getInstitutionalRules($demographicField),
            ClaimType::PROFESSIONAL->value => $this->getProfessionalRules($demographicField),
            default => throw new \InvalidArgumentException('Invalid format type'),
        };
    }

    /**
     * @param array<string, mixed> $demographicField
     *
     * @return array<string, mixed>
     */
    protected function getInstitutionalRules(array $demographicField): array
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'type' => ['required', 'integer'],
            'draft' => ['nullable', 'boolean'],
            'private_note' => [
                Rule::excludeIf(fn () => false === $this->input('draft', false)),
                'string',
                'nullable',
            ],
            'sub_status_id' => [
                Rule::excludeIf(fn () => false === $this->input('draft', false)),
                'integer',
                'nullable',
            ],

            'demographic_information' => ['required', 'array'],
            'demographic_information.type_of_medical_assistance' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'string',
            ],
            'demographic_information.bill_classification' => ['required', 'integer'],
            'demographic_information.validate' => ['nullable', 'boolean'],
            'demographic_information.automatic_eligibility' => ['nullable', 'boolean'],
            'demographic_information.company_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
            ],
            'demographic_information.facility_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
            ],
            'demographic_information.patient_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
            ],
            'demographic_information.prior_authorization_number' => ['nullable', 'string'],
            'demographic_information.accept_assignment' => ['nullable', 'boolean'],
            'demographic_information.patient_signature' => ['nullable', 'boolean'],
            'demographic_information.insured_signature' => ['nullable', 'boolean'],
            'demographic_information.outside_lab' => ['nullable', 'boolean'],
            'demographic_information.charges' => ['nullable', 'numeric'],
            'demographic_information.employment_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_place_state' => [
                Rule::requiredIf(fn () => $demographicField['auto_accident_related_condition'] ?? false === true),
                'nullable',
                'string',
                'max:2',
            ],
            'demographic_information.other_accident_related_condition' => ['nullable', 'boolean'],

            'demographic_information.health_professional_qualifier' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'array',
                new ArrayCountRule(1),
            ],
            'demographic_information.health_professional_qualifier.*.field_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.health_professional_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.qualifier_id' => ['nullable', 'integer'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.services' => ['array', 'nullable'],
            'claim_services.services.*.id' => ['nullable', 'integer'],
            'claim_services.services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.procedure_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.services.*.revenue_code_id' => [Rule::requiredIf(fn () => false === $this->input('draft', false)), 'nullable', 'integer'],
            'claim_services.services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.days_or_units' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.total_charge' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.copay' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.diagnoses' => ['array', 'nullable'],
            'claim_services.diagnoses.*.item' => ['string', 'nullable'],
            'claim_services.diagnoses.*.diagnosis_id' => ['integer', 'nullable'],
            'claim_services.diagnoses.*.admission' => ['boolean', 'nullable'],
            'claim_services.diagnoses.*.poa' => ['string', 'max:1', 'nullable'],

            'additional_information' => ['nullable', 'array'],
            'additional_information.from' => ['required', 'date'],
            'additional_information.to' => ['required', 'date'],
            'additional_information.diagnosis_related_group_id' => ['nullable', 'integer'],
            'additional_information.non_covered_charges' => ['nullable', 'numeric'],
            'additional_information.patient_information.admission_date' => [
                'nullable',
                'date',
            ],
            'additional_information.patient_information.admission_time' => ['nullable', 'date_format:H:i:s'],
            'additional_information.patient_information.discharge_date' => [
                'nullable',
                'date',
            ],
            'additional_information.patient_information.discharge_time' => ['nullable', 'date_format:H:i:s'],
            'additional_information.patient_information.condition_code_ids' => ['nullable', 'array'],
            'additional_information.patient_information.admission_type_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
                'nullable',
            ],
            'additional_information.patient_information.admission_source_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
                'nullable',
            ],
            'additional_information.patient_information.patient_status_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
                'nullable',
            ],
            'additional_information.patient_information.bill_classification_id' => ['nullable', 'integer'],

            'additional_information.claim_date_informations' => ['nullable', 'array'],
            'additional_information.claim_date_informations.*.id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.field_id' => ['sometimes', 'integer'],
            'additional_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.from_date' => ['sometimes', 'date'],
            'additional_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'additional_information.claim_date_informations.*.description' => ['nullable', 'string'],
            'additional_information.claim_date_informations.*.amount' => ['nullable', 'numeric'],

            'additional_information.extra_information' => ['nullable', 'array'],

            'insurance_policies' => ['array', 'nullable'],
            'insurance_policies.*.insurance_policy_id' => ['sometimes', 'nullable', 'integer'],
            'insurance_policies.*.order' => ['sometimes', 'nullable', 'integer'],
        ];
    }

    /**
     * @param array<string, mixed> $demographicField
     *
     * @return array<string, mixed>
     */
    protected function getProfessionalRules(array $demographicField): array
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'type' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
            ],
            'draft' => ['nullable', 'boolean'],
            'private_note' => [
                Rule::excludeIf(fn () => false === $this->input('draft', false)),
                'string',
                'nullable',
            ],
            'sub_status_id' => [
                Rule::excludeIf(fn () => false === $this->input('draft', false)),
                'integer',
                'nullable',
            ],

            'demographic_information' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'array',
            ],
            'demographic_information.validate' => ['nullable', 'boolean'],
            'demographic_information.automatic_eligibility' => ['nullable', 'boolean'],
            'demographic_information.company_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
            ],
            'demographic_information.facility_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
            ],
            'demographic_information.patient_id' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'integer',
            ],
            'demographic_information.prior_authorization_number' => ['nullable', 'string'],
            'demographic_information.accept_assignment' => ['nullable', 'boolean'],
            'demographic_information.patient_signature' => ['nullable', 'boolean'],
            'demographic_information.insured_signature' => ['nullable', 'boolean'],
            'demographic_information.outside_lab' => ['nullable', 'boolean'],
            'demographic_information.charges' => ['nullable', 'numeric'],
            'demographic_information.employment_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_place_state' => [
                Rule::requiredIf(fn () => $demographicField['auto_accident_related_condition'] ?? false === true),
                'nullable',
                'string',
                'max:2',
            ],
            'demographic_information.other_accident_related_condition' => ['nullable', 'boolean'],

            'demographic_information.health_professional_qualifier' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'array',
                new ArrayCountRule(1),
            ],
            'demographic_information.health_professional_qualifier.*.field_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.health_professional_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.qualifier_id' => ['nullable', 'integer'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.services' => ['array', 'nullable'],
            'claim_services.services.*.id' => ['nullable', 'integer'],
            'claim_services.services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.procedure_id' => [Rule::requiredIf(fn () => false === $this->input('draft', false)), 'nullable', 'integer'],
            'claim_services.services.*.modifier_ids' => ['sometimes', 'nullable', 'array'],
            'claim_services.services.*.place_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.services.*.type_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.services.*.diagnostic_pointers' => [
                Rule::requiredIf(fn () => false === $this->input('draft', false)),
                'nullable',
                'array',
            ],
            'claim_services.services.*.days_or_units' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.copay' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.emg' => ['nullable', 'boolean'],
            'claim_services.services.*.epsdt_id' => ['nullable', 'integer'],
            'claim_services.services.*.family_planning_id' => ['nullable', 'integer'],
            'claim_services.diagnoses' => ['array', 'nullable'],
            'claim_services.diagnoses.*.item' => ['string', 'nullable'],
            'claim_services.diagnoses.*.diagnosis_id' => ['integer', 'nullable'],

            'additional_information' => ['nullable', 'array'],
            'additional_information.claim_date_informations' => ['nullable', 'array'],
            'additional_information.claim_date_informations.*.id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.field_id' => ['sometimes', 'integer'],
            'additional_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.from_date' => ['sometimes', 'date'],
            'additional_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'additional_information.claim_date_informations.*.description' => ['nullable', 'string'],

            'additional_information.extra_information' => ['nullable', 'array'],

            'insurance_policies' => ['array', 'nullable'],
            'insurance_policies.*.insurance_policy_id' => ['sometimes', 'nullable', 'integer'],
            'insurance_policies.*.order' => ['sometimes', 'nullable', 'integer'],
        ];
    }
}
