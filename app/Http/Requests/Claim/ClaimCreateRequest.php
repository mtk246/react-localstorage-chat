<?php

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [      
            "format"                         => ['required', 'integer'],
            "company_id"                     => ['required', 'integer'],
            "facility_id"                    => ['required', 'integer'],
            "patient_id"                     => ['required', 'integer'],
            "health_professional_id"         => ['required', 'integer'],
            
            "diagnoses"                      => ["array", "nullable"],
            "insurance_policies"             => ["array", "nullable"],

            "claim_services"                       => ["array", "nullable"],
            "claim_services.*.from_service"          => ["sometimes", "nullable", "date"],
            "claim_services.*.to_service"            => ["sometimes", "nullable", "date"],
            "claim_services.*.procedure_id"          => ["sometimes", "nullable", "integer"],
            "claim_services.*.modifier_id"           => ["sometimes", "nullable", "integer"],
            "claim_services.*.rev_center_id"         => ["sometimes", "nullable", "integer"],
            "claim_services.*.place_of_service_id"   => ["sometimes", "nullable", "integer"],
            "claim_services.*.type_of_service_id"    => ["sometimes", "nullable", "integer"],
            "claim_services.*.diagnostic_pointer_id" => ["sometimes", "nullable", "integer"],
            "claim_services.*.std_id"                => ["sometimes", "nullable", "numeric"],
            "claim_services.*.price"                 => ["sometimes", "nullable", "numeric"]
        ];
    }
}

