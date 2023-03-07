<?php

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\TypeForm;

class ClaimCreateRequest extends FormRequest
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
        $insuredField = $this->input('patient_or_insured_information');
        return [
            'billing_company_id'       => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'format'                         => ['required', 'integer'],
            'validate'                       => ['nullable', 'boolean'],
            'automatic_eligibility'          => ['nullable', 'boolean'],
            'company_id'                     => ['required', 'integer'],
            'facility_id'                    => ['required', 'integer'],
            'patient_id'                     => ['required', 'integer'],
            
            'billing_provider_id'         => ['required', 'integer'],
            'service_provider_id'         => ['nullable', 'integer'],
            'referred_id'                 => ['nullable', 'integer'],
            "referred_provider_role_id"   => ['nullable', 'integer'],

            'patient_or_insured_information'                                  => ['nullable', 'array'],
            'patient_or_insured_information.employment_related_condition'     => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_related_condition'  => ['nullable', 'boolean'],
            'patient_or_insured_information.auto_accident_place_state'        => [
                Rule::requiredIf(function () use ($insuredField)
                    { return ($insuredField['auto_accident_related_condition'] ?? false == true); }),
                'nullable',
                'string',
                'max:2'
            ],
            'patient_or_insured_information.other_accident_related_condition' => ['nullable', 'boolean'],
            'patient_or_insured_information.patient_signature'                => ['nullable', 'boolean'],
            'patient_or_insured_information.insured_signature'                => ['nullable', 'boolean'],

            "physician_or_supplier_information"                            => ['nullable', 'array'],
            "physician_or_supplier_information.prior_authorization_number" => ['nullable', 'string'],
            "physician_or_supplier_information.outside_lab"                => ['nullable', 'boolean'],
            "physician_or_supplier_information.charges"                    => ['nullable', 'numeric'],
            "physician_or_supplier_information.patient_account_num"        => ['nullable', 'string'],
            "physician_or_supplier_information.accept_assignment"          => ['nullable', 'boolean'],

            "physician_or_supplier_information.claim_date_informations"                        => ['nullable', 'array'],
            "physician_or_supplier_information.claim_date_informations.*.field_id"             => ['sometimes', 'integer'],
            "physician_or_supplier_information.claim_date_informations.*.qualifier_id"         => ['sometimes', 'integer'],
            "physician_or_supplier_information.claim_date_informations.*.from_date_or_current" => ['nullable', 'date'],
            "physician_or_supplier_information.claim_date_informations.*.to_date"              => ['nullable', 'date'],
            "physician_or_supplier_information.claim_date_informations.*.description"          => ['nullable', 'string'],

            /**'type_of_bill'           => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:3'
                                        ],
            'federal_tax_number'     => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:50'
                                        ],
            'start_date_service'     => ['nullable', 'date'],
            'end_date_service'       => ['nullable', 'date'],
            'admission_date'         => ['nullable', 'date'],
            'admission_hour'         => ['nullable', 'integer'],
            'type_of_admission'      => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:1'
                                        ],
            'source_admission'       => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:1'
                                        ],
            'discharge_hour'         => ['nullable', 'integer'],
            'patient_discharge_stat' => ['nullable', 'integer'],
            'admit_dx'               => ['nullable', 'integer'],*/
            
            'diagnoses'                      => ['array', 'nullable'],
            'diagnoses.*.item'               => ['string', 'nullable'],
            'diagnoses.*.diagnosis_id'       => ['integer', 'nullable'],

            'insurance_policies'             => ['array', 'nullable'],

            'claim_services'                       => ['nullable', 'array'],
            'claim_services.*.from_service'        => ['sometimes', 'nullable', 'date'],
            'claim_services.*.to_service'          => ['sometimes', 'nullable', 'date'],
            'claim_services.*.procedure_id'        => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.modifier_ids'        => ['sometimes', 'nullable', 'array'],
            'claim_services.*.place_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.type_of_service_id'  => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.diagnostic_pointers' => ['sometimes', 'nullable', 'array'],
            'claim_services.*.days_or_units'       => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.price'               => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.copay'               => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.emg'                 => ['nullable', 'boolean'],
            'claim_services.*.epsdt_id'            => ['nullable', 'integer'],
            'claim_services.*.family_planning_id'  => ['nullable', 'integer'],
        ];
    }
}

