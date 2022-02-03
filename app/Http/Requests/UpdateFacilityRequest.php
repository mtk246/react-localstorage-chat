<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacilityRequest extends FormRequest
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
            "facility" => "sometimes|array",
            "facility.type" => "sometimes|integer",
            "facility.name" => "sometimes|string|unique:facilities,name",
            "facility.company_name" => "sometimes|string|unique:facilities,name",
            "facility.npi" => "sometimes|string",
            "facility.taxonomy" => "sometimes|string",
            "facility.billing_company_id" => "sometimes|integer",
            "address" => "sometimes|array",
            'address.address' => "sometimes|string",
            'address.city' => "sometimes|string",
            'address.state' => "sometimes|string",
            'address.zip' => "sometimes|numeric",
            "contact" => "sometimes|array",
            "contact.phone" => "sometimes|string",
            "contact.fax" => "sometimes|string",
            "contact.email" => "sometimes|email:rfc",
        ];
    }
}
