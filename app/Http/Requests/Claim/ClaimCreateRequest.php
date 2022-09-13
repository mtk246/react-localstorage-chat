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

            "services"                       => ["array", "nullable"],
            "services.*.procedure_id"        => ["sometimes", "nullable", "integer"],
            "services.*.modifier_id"         => ["sometimes", "nullable", "integer"],
            "services.*.rev_center_id"       => ["sometimes", "nullable", "integer"],
            "services.*.place_of_service_id" => ["sometimes", "nullable", "integer"],
            "services.*.type_of_service_id"  => ["sometimes", "nullable", "integer"],
            "services.*.diagnostic_pointers" => ["sometimes", "nullable", "string"],
            "services.*.std"                 => ["sometimes", "nullable", "numeric"],
            "services.*.price"               => ["sometimes", "nullable", "numeric"]
        ];
    }
}

""
