<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Models\TypeForm;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClaimVerifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $typeFormat = TypeForm::findOrFail($this->input('format'));
        $insuredField = $this->input('patient_or_insured_information');

        return ('UB-04 / 837I' == $typeFormat->form)
            ? $this->getUB04Rules($insuredField)
            : (('CMS-1500 / 837P' == $typeFormat->form)
                ? $this->getCMS1500Rules($insuredField)
                : []);
    }

    protected function getUB04Rules($insuredField)
    {
        return [
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'format' => ['required', 'integer'],
            'validate' => ['nullable', 'boolean'],
            'automatic_eligibility' => ['nullable', 'boolean'],
            'company_id' => ['required', 'integer'],
            'facility_id' => ['required', 'integer'],
            'patient_id' => ['required', 'integer'],

            'type_of_medical_assistance' => ['required', 'string'],
            'health_professional_qualifier' => ['required', 'array', 'min:1'],
            'health_professional_qualifier.*.field_id' => ['nullable', 'integer'],
            'health_professional_qualifier.*.health_professional_id' => ['nullable', 'integer'],
            'health_professional_qualifier.*.qualifier_id' => ['nullable', 'integer'],
            'health_professional_qualifier.0.field_id' => ['required', 'integer'],
            'health_professional_qualifier.0.health_professional_id' => ['required', 'integer'],

            'prior_authorization_number' => ['nullable', 'string'],
            'employment_related_condition' => ['nullable', 'boolean'],
            'auto_accident_related_condition' => ['nullable', 'boolean'],
            'auto_accident_place_state' => [
                Rule::requiredIf(function () use ($insuredField) { return $insuredField['auto_accident_related_condition'] ?? false == true; }),
                'nullable',
                'string',
                'max:2',
            ],
            'other_accident_related_condition' => ['nullable', 'boolean'],
            'accept_assignment' => ['nullable', 'boolean'],
            'patient_signature' => ['nullable', 'boolean'],
            'insured_signature' => ['nullable', 'boolean'],
            'outside_lab' => ['nullable', 'boolean'],
            'charges' => ['nullable', 'numeric'],

            'claim_services' => ['nullable', 'array'],
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
            'additional_information.claim_date_informations.*.field_id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'additional_information.claim_date_informations.*.from_date' => ['sometimes', 'date'],
            'additional_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'additional_information.claim_date_informations.*.through' => ['nullable', 'string'],
            'additional_information.claim_date_informations.*.amount' => ['nullable', 'numeric'],

            'diagnoses' => ['array', 'nullable'],
            'diagnoses.*.item' => ['string', 'nullable'],
            'diagnoses.*.diagnosis_id' => ['integer', 'nullable'],
            'diagnoses.*.admission' => ['boolean', 'nullable'],
            'diagnoses.*.poa' => ['string', 'max:1', 'nullable'],

            'insurance_policies' => ['array', 'required'],
            'private_note' => ['string', 'nullable'],
        ];
    }

    protected function getCMS1500Rules($insuredField)
    {
        return [
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'format' => ['required', 'integer'],
            'validate' => ['nullable', 'boolean'],
            'automatic_eligibility' => ['nullable', 'boolean'],
            'company_id' => ['required', 'integer'],
            'facility_id' => ['required', 'integer'],
            'patient_id' => ['required', 'integer'],

            'billing_provider_id' => ['required', 'integer'],
            'service_provider_id' => ['nullable', 'integer'],
            'referred_id' => ['nullable', 'integer'],
            'referred_provider_role_id' => ['nullable', 'integer'],

            'patient_or_insured_information' => ['nullable', 'array'],
            'patient_or_insured_information.employment_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_place_state' => [
                Rule::requiredIf(function () use ($insuredField) { return $insuredField['auto_accident_related_condition'] ?? false == true; }),
                'nullable',
                'string',
                'max:2',
            ],
            'patient_or_insured_information.other_accident_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.patient_signature' => ['nullable', 'boolean'],
            'patient_or_insured_information.insured_signature' => ['nullable', 'boolean'],

            'physician_or_supplier_information' => ['nullable', 'array'],
            'physician_or_supplier_information.prior_authorization_number' => ['nullable', 'string'],
            'physician_or_supplier_information.outside_lab' => ['nullable', 'boolean'],
            'physician_or_supplier_information.charges' => ['nullable', 'numeric'],
            'physician_or_supplier_information.patient_account_num' => ['nullable', 'string'],
            'physician_or_supplier_information.accept_assignment' => ['nullable', 'boolean'],

            'physician_or_supplier_information.claim_date_informations' => ['nullable', 'array'],
            'physician_or_supplier_information.claim_date_informations.*.field_id' => ['sometimes', 'integer'],
            'physician_or_supplier_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'physician_or_supplier_information.claim_date_informations.*.from_date_or_current' => ['nullable', 'date'],
            'physician_or_supplier_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'physician_or_supplier_information.claim_date_informations.*.description' => ['nullable', 'string'],

            'diagnoses' => ['array', 'nullable'],
            'diagnoses.*.item' => ['string', 'nullable'],
            'diagnoses.*.diagnosis_id' => ['integer', 'nullable'],

            'insurance_policies' => ['array', 'required'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.procedure_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.modifier_ids' => ['sometimes', 'nullable', 'array'],
            'claim_services.*.place_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.type_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.diagnostic_pointers' => ['sometimes', 'nullable', 'array'],
            'claim_services.*.days_or_units' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.copay' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.emg' => ['nullable', 'boolean'],
            'claim_services.*.epsdt_id' => ['nullable', 'integer'],
            'claim_services.*.family_planning_id' => ['nullable', 'integer'],

            'private_note' => ['string', 'nullable'],
        ];
    }
}
