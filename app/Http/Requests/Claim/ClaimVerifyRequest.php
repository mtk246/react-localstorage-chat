<?php

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\TypeForm;

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
        $typeFormat = TypeForm::find($this->input('format'));
        return [
            "format"                         => ['nullable', 'integer'],
            "company_id"                     => ['nullable', 'integer'],
            "facility_id"                    => ['nullable', 'integer'],
            "patient_id"                     => ['nullable', 'integer'],
            "health_professional_id"         => ['nullable', 'integer'],
            "control_number"                 => ['nullable', 'string'],
            'validate'                       => ['nullable', 'boolean'],

            "type_of_bill"           => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:3'
                                        ],
            "federal_tax_number"     => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:50'
                                        ],
            "start_date_service"     => ['nullable', 'date'],
            "end_date_service"       => ['nullable', 'date'],
            "admission_date"         => ['nullable', 'date'],
            "admission_hour"         => ['nullable', 'integer'],
            "type_of_admission"      => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:1'
                                        ],
            "source_admission"       => [
                                            Rule::requiredIf(function () use ($typeFormat)
                                                { return ($typeFormat->form == 'UB-04 / 837I'); }),
                                            'string', 'max:1'
                                        ],
            "discharge_hour"         => ['nullable', 'integer'],
            "patient_discharge_stat" => ['nullable', 'integer'],
            "admit_dx"               => ['nullable', 'integer'],
            
            "diagnoses"                      => ["array", "nullable"],
            "diagnoses.*.item"               => ["string", "nullable"],
            "diagnoses.*.diagnosis_id"       => ["integer", "nullable"],

            "insurance_policies"             => ["array", "required"],

            "claim_services"                       => ["array", "nullable"],
            "claim_services.*.from_service"        => ["sometimes", "nullable", "date"],
            "claim_services.*.to_service"          => ["sometimes", "nullable", "date"],
            "claim_services.*.procedure_id"        => ["sometimes", "nullable", "integer"],
            "claim_services.*.modifier_id"         => ["sometimes", "nullable", "integer"],
            "claim_services.*.rev"                 => ["sometimes", "nullable", "integer"],
            "claim_services.*.place_of_service_id" => ["sometimes", "nullable", "integer"],
            "claim_services.*.type_of_service_id"  => ["sometimes", "nullable", "integer"],
            "claim_services.*.diagnostic_pointers" => ["sometimes", "nullable", "array"],
            "claim_services.*.epstd"               => ["sometimes", "nullable", "integer"],
            "claim_services.*.price"               => ["sometimes", "nullable", "numeric"],

            "private_note"                         => ["string", "nullable"],

            'will_report_injuries'                 => ['nullable', 'boolean'],
            'injuries'                             => ['nullable', 'array'],
            'injuries.*.diag_date'                 => ['nullable', 'date'],
            'injuries.*.diagnosis_id'              => ['nullable', 'integer'],
            'injuries.*.type_diag_id'              => ['nullable', 'integer'],
            'injuries.*.note'                      => ['nullable', 'string']
        ];
    }
}
