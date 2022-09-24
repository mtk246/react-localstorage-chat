<?php

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [      
            "format"                         => ['nullable', 'integer'],
            "company_id"                     => ['nullable', 'integer'],
            "facility_id"                    => ['nullable', 'integer'],
            "patient_id"                     => ['nullable', 'integer'],
            "health_professional_id"         => ['nullable', 'integer'],
            
            "diagnoses"                      => ["array", "nullable"],
            "diagnoses.*.item"               => ["string", "nullable"],
            "diagnoses.*.diagnosis_id"       => ["integer", "nullable"],

            "insurance_policies"             => ["array", "nullable"],

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
            "claim_services.*.price"               => ["sometimes", "nullable", "numeric"]
        ];
    }
}

