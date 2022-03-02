<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacilityCreateRequest extends FormRequest
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
            "facility" => ["required", "array"],
            "facility.type" => ["required", "integer"],
            "facility.name"         => ["required", "string", Rule::unique('facilities', 'name')],
            "facility.company_name" => ["required", "string", Rule::unique('facilities', 'company_name')],
            "facility.npi"          => ["required", "string"],
            "facility.taxonomy"     => ["required", "string"],
            "facility.company_id"   => ["required", "integer"],
            "address"               => ["required", "array"],
            'address.address'       => ["required", "string"],
            'address.city'          => ["required", "string"],
            'address.state'         => ["required", "string"],
            'address.zip'           => ["required", "numeric"],
            "contact"               => ["required", "array"],
            "contact.phone"         => ["required", "string"],
            "contact.fax"           => ["required", "string"],
            "contact.email"         => ["required", "email:rfc"],
        ];
    }
}
