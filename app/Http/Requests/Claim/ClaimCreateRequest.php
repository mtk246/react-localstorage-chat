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
            
            "format"                                      => ['required', 'integer'],
            "company_id"                                  => ['required', 'integer'],
            "facility_id"                                 => ['required', 'integer'],
            "patient_id"                                  => ['required', 'integer'],
            "insurance_company_id"                        => ['required', 'integer'],
            "health_professional_id"                      => ['required', 'integer'],
            
            "claim_service_lines"                         => ["array", "nullable"],
            "claim_service_lines.*.procedure_id"          => ["sometimes", "nullable", "integer"],
            "claim_service_lines.*.modifier_id"           => ["sometimes", "nullable", "integer"],
            "claim_service_lines.*.rev_center_id"         => ["sometimes", "nullable", "integer"],
            "claim_service_lines.*.place_of_service_id"   => ["sometimes", "nullable", "integer"],
            "claim_service_lines.*.type_of_service_id"    => ["sometimes", "nullable", "integer"],
            "claim_service_lines.*.diagnostic_pointers"   => ["sometimes", "nullable", "string"],
            
            'diagnoses'                                          => ['nullable', 'array'],
        ];
    }
}

""
