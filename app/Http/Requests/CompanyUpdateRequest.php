<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Company;

class CompanyUpdateRequest extends FormRequest
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
            "company" => "required|array",
            "company.code"     => ["sometimes", "string", Rule::unique('companies', 'code')->ignore($this->company["id"])],
            "company.name"     => ["sometimes", "string", Rule::unique('companies', 'name')->ignore($this->company["id"])],
            "company.npi"      => ["sometimes", "string", Rule::unique('companies', 'npi')->ignore($this->company["id"])],
            "address" => "required|array",
            'address.address' => "sometimes|string",
            'address.city'    => "sometimes|string",
            'address.state'   => "sometimes|string",
            'address.zip'     => "sometimes|numeric",
            "contact"         => "sometimes|array",
            "contact.phone"   => "sometimes|string",
            "contact.fax"     => "sometimes|string",
            "contact.email"   => "sometimes|email:rfc",
        ];
    }
}
