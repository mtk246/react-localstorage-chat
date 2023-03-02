<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

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
            'group_number'         => ['nullable', 'numeric'],
            'eff_date'             => ['required', 'date'],
            'end_date'             => ['nullable', 'date'],
            'type_responsibility_id'      => ['required', 'integer'],
            'insurance_policy_type_id'    => ['nullable', 'integer'],
            'release_info'         => ['required', 'boolean'],
            'assign_benefits'      => ['required', 'boolean'],
            'own_insurance'        => ['required', 'boolean'],

            'subscriber'            => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'subscriber.ssn'        => ['required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.date_of_birth'  => ['nullable', 'date'],
            'subscriber.first_name' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.last_name'  => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],

            'subscriber.address'         => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'subscriber.address.address' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.address.city'    => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.address.state'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.address.zip'     => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            
            'subscriber.contact'         => ['sometimes', 'required_if:own_insurance,false', 'array'],
            'subscriber.contact.phone'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.contact.mobile'  => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.contact.fax'     => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.contact.email'   => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'email:rfc'],
        ];
    }
}
