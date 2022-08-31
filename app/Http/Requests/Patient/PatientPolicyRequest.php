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
            'insurance_policies'                        => ['required', 'array'],
            'insurance_policies.*.insurance_company'    => ['required', 'numeric'],
            'insurance_policies.*.policy_number'        => ['required', 'numeric'],
            'insurance_policies.*.insurance_plan'       => ['required', 'numeric'],
            'insurance_policies.*.own_insurance'        => ['required', 'boolean'],

            'insurance_policies.*.suscriber'            => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.suscriber.ssn'        => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.first_name' => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.last_name'  => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],

            'insurance_policies.*.suscriber.address'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.suscriber.address.address' => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.address.city'    => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.address.state'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.address.zip'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            
            'insurance_policies.*.suscriber.contact'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.suscriber.contact.phone'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.contact.fax'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.suscriber.contact.email'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'email:rfc'],
        ];
    }
}
