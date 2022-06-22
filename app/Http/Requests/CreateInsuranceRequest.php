<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInsuranceRequest extends FormRequest
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
            'billing_company_id'    => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'insurance'             => ['required', 'array'],
            'insurance.name'        => ['required', 'string', Rule::unique('insurance_companies', 'name')],
            'insurance.naic'        => ['required', 'string'],
            'insurance.file_method' => ['required', 'string'],
            'insurance.nickname'    => ['sometimes', 'string'],
            
            'address'               => ['required', 'array'],
            'address.address'       => ['required', 'string'],
            'address.city'          => ['required', 'string'],
            'address.state'         => ['required', 'string'],
            'address.zip'           => ['required', 'string'],
            
            'contact'               => ['required', 'array'],
            'contact.phone'         => ['required', 'string'],
            'contact.fax'           => ['nullable', 'string'],
            'contact.email'         => ['required', 'email:rfc'],
        ];
    }
}
