<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientPolicyRequest extends FormRequest
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
            'insurance_company'    => ['required', 'numeric'],
            'policy_number'        => ['required', 'numeric'],
            'insurance_plan'       => ['required', 'numeric'],
            'own_insurance'        => ['required', 'boolean'],

            'suscriber'            => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'suscriber.ssn'        => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.first_name' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.last_name'  => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],

            'suscriber.address'         => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'suscriber.address.address' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.address.city'    => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.address.state'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.address.zip'     => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            
            'suscriber.contact'         => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'suscriber.contact.phone'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.contact.fax'     => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'suscriber.contact.email'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'email:rfc'],
        ];
    }
}
