<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsuranceRequest extends FormRequest
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
            "insurance" => "sometimes|array",
            'insurance.name' => "sometimes|string",
            'insurance.naic' => "sometimes|string",
            'insurance.file_method' => "sometimes|string",
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
