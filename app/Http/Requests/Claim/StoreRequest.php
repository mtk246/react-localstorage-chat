<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Rules\ArrayCountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        $insuredField = $this->input('patient_or_insured_information');

        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'type' => ['required', 'integer'],
            'format' => ['required', 'integer'],
            'aditional_information' => ['nullable', 'array'],

            'demographic_information' => ['required', 'array'],
            'demographic_information.type_of_medical_assistance' => ['required', 'string'],
            'demographic_information.validate' => ['nullable', 'boolean'],
            'demographic_information.automatic_eligibility' => ['nullable', 'boolean'],
            'demographic_information.company_id' => ['required', 'integer'],
            'demographic_information.facility_id' => ['required', 'integer'],
            'demographic_information.patient_id' => ['required', 'integer'],
            'demographic_information.prior_authorization_number' => ['nullable', 'string'],
            'demographic_information.accept_assignment' => ['nullable', 'boolean'],
            'demographic_information.patient_signature' => ['nullable', 'boolean'],
            'demographic_information.insured_signature' => ['nullable', 'boolean'],
            'demographic_information.outside_lab' => ['nullable', 'boolean'],
            'demographic_information.charges' => ['nullable', 'numeric'],
            'demographic_information.employment_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_related_condition' => ['nullable', 'boolean'],
            'demographic_information.auto_accident_place_state' => [
                Rule::requiredIf(function () use ($insuredField) { return $insuredField['auto_accident_related_condition'] ?? false == true; }),
                'nullable',
                'string',
                'max:2',
            ],
            'demographic_information.other_accident_related_condition' => ['nullable', 'boolean'],

            'demographic_information.health_professional_qualifier' => ['required', 'array', new ArrayCountRule(1)],
            'demographic_information.health_professional_qualifier.*.field_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.health_professional_id' => ['nullable', 'integer'],
            'demographic_information.health_professional_qualifier.*.qualifier_id' => ['nullable', 'integer'],

            'demographic_information.diagnoses' => ['array', 'nullable'],
            'demographic_information.diagnoses.*.item' => ['string', 'nullable'],
            'demographic_information.diagnoses.*.diagnosis_id' => ['integer', 'nullable'],
            'demographic_information.diagnoses.*.admission' => ['boolean', 'nullable'],
            'demographic_information.diagnoses.*.poa' => ['string', 'max:1', 'nullable'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.*.id' => ['nullable', 'integer'],
            'claim_services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.procedure_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.revenue_code_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.units_of_service' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.total_charge' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.copay' => ['sometimes', 'nullable', 'numeric'],

            'additional_information' => ['nullable', 'array'],
            'additional_information.admission_date' => ['sometimes', 'date'],
            'additional_information.admission_time' => ['nullable', 'date_format:H:i:s'],
            'additional_information.discharge_date' => ['sometimes', 'date'],
            'additional_information.discharge_time' => ['nullable', 'date_format:H:i:s'],
            'additional_information.condition_code_ids' => ['nullable', 'array'],
            'additional_information.admission_type_id' => ['required', 'integer'],
            'additional_information.admission_source_id' => ['required', 'integer'],
            'additional_information.patient_status_id' => ['required', 'integer'],
            'additional_information.bill_classification_id' => ['nullable', 'integer'],
            'additional_information.diagnosis_related_group_id' => ['nullable', 'integer'],
            'additional_information.non_covered_charges' => ['nullable', 'numeric'],

            'additional_information.claim_date_informations' => ['nullable', 'array'],
            'additional_information.claim_date_informations.*.id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.field_id' => ['sometimes', 'integer'],
            'additional_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.from_date' => ['sometimes', 'date'],
            'additional_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'additional_information.claim_date_informations.*.through' => ['nullable', 'string'],
            'additional_information.claim_date_informations.*.amount' => ['nullable', 'numeric'],

            'insurance_policies' => ['array', 'nullable'],
        ];
    }
}
