<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Models\TypeForm;
use Illuminate\Foundation\Http\FormRequest;

class ClaimDraftRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $typeFormat = TypeForm::find($this->input('format'));

        return [
            'billing_company_id' => ['nullable', 'integer'],
            'claim_id' => ['nullable', 'integer'],
            'format' => ['nullable', 'integer'],
            'validate' => ['nullable', 'boolean'],
            'automatic_eligibility' => ['nullable', 'boolean'],
            'company_id' => ['nullable', 'integer'],
            'facility_id' => ['nullable', 'integer'],
            'patient_id' => ['nullable', 'integer'],
            'billing_provider_id' => ['nullable', 'integer'],
            'service_provider_id' => ['nullable', 'integer'],
            'referred_id' => ['nullable', 'integer'],
            'referred_provider_role_id' => ['nullable', 'integer'],

            'patient_or_insured_information' => ['nullable', 'array'],
            'patient_or_insured_information.employment_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_place_state' => ['nullable', 'string', 'max:2'],
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
            'physician_or_supplier_information.claim_date_informations.*.field_id' => ['nullable', 'integer'],
            'physician_or_supplier_information.claim_date_informations.*.qualifier_id' => ['nullable', 'integer'],
            'physician_or_supplier_information.claim_date_informations.*.from_date_or_current' => ['nullable', 'date'],
            'physician_or_supplier_information.claim_date_informations.*.to_date' => ['nullable', 'date'],
            'physician_or_supplier_information.claim_date_informations.*.description' => ['nullable', 'string'],

            'diagnoses' => ['nullable', 'array'],
            'diagnoses.*.item' => ['nullable', 'string'],
            'diagnoses.*.diagnosis_id' => ['nullable', 'integer'],

            'insurance_policies' => ['nullable', 'array'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.*.from_service' => ['nullable', 'date'],
            'claim_services.*.to_service' => ['nullable', 'date'],
            'claim_services.*.procedure_id' => ['nullable', 'integer'],
            'claim_services.*.modifier_ids' => ['nullable', 'array'],
            'claim_services.*.place_of_service_id' => ['nullable', 'integer'],
            'claim_services.*.type_of_service_id' => ['nullable', 'integer'],
            'claim_services.*.diagnostic_pointers' => ['nullable', 'array'],
            'claim_services.*.days_or_units' => ['nullable', 'numeric'],
            'claim_services.*.price' => ['nullable', 'numeric'],
            'claim_services.*.copay' => ['nullable', 'numeric'],
            'claim_services.*.emg' => ['nullable', 'boolean'],
            'claim_services.*.epsdt_id' => ['nullable', 'integer'],
            'claim_services.*.family_planning_id' => ['nullable', 'integer'],

            'private_note' => ['string', 'nullable'],
            'sub_status_id' => ['integer', 'nullable'],
        ];
    }
}
