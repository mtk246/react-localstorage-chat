<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientCreateRequest extends FormRequest
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
            'driver_license'                    => ['required', 'string'],
            'public_note'                       => ['sometimes', 'required', 'string'],
            'private_note'                      => ['sometimes', 'required', 'string'],

            'patient_condition_related'                => ['nullable', 'array'],
            'patient_condition_related.employment'     => ['nullable', 'boolean'],
            'patient_condition_related.auto_accident'  => ['nullable', 'boolean'],
            'patient_condition_related.place_state'    => ['nullable', 'string'],
            'patient_condition_related.other_accident' => ['nullable', 'boolean'],

            'billing_company_id'                => [Rule::requiredIf(auth()->user()->hasRole('superuser')),'integer', 'nullable'],

            'patient_private'                   => ['required', 'array'],
            'patient_private.reference_num'     => ['required', 'string'],
            'patient_private.med_num'           => ['required', 'string'],
            'patient_private.patient_num'       => ['required', 'string'],

            'profile'                           => ['required', 'array'],
            'profile.ssn'                       => ['required', 'string'],
            'profile.first_name'                => ['required', 'string', 'max:20'],
            'profile.last_name'                 => ['required', 'string', 'max:20'],
            'profile.middle_name'               => ['nullable', 'string', 'max:20'],
            'profile.date_of_birth'             => ['required', 'date'],
            'profile.sex'                       => ['required', 'string', 'max:1'],

            'profile.social_medias'             => ['sometimes', 'required', 'array'],
            'profile.social_medias.*.name'      => ['sometimes', 'required', 'string'],
            'profile.social_medias.*.link'      => ['sometimes', 'required', 'string'],

            'address'                           => ['required', 'array'],
            'address.address'                   => ['required', 'string'],
            'address.city'                      => ['required', 'string'],
            'address.state'                     => ['required', 'string'],
            'address.zip'                       => ['required', 'string'],
            
            'contact'                           => ['required', 'array'],
            'contact.phone'                     => ['required', 'string'],
            'contact.fax'                       => ['nullable', 'string'],
            'contact.email'                     => ['required', Rule::unique('users', 'email'), 'string', 'email:rfc'],

            'marital'                           => ['nullable', 'array'],
            'marital.spuse_name'                => ['nullable', 'string'],
            'marital.spuse_work'                => ['nullable', 'string'],
            'marital.spuse_work_phone'          => ['nullable', 'string'],

            
            'guarantor'                         => ['nullable', 'array'],
            'guarantor.name'                    => ['nullable', 'string'],
            'guarantor.phone'                   => ['nullable', 'string'],

            'employments'                       => ['sometimes', 'required', 'array'],
            'employments.*.employer_name'       => ['sometimes', 'required', 'string'],
            'employments.*.employer_address'    => ['sometimes', 'required', 'string'],
            'employments.*.employer_phone'      => ['sometimes', 'required', 'string'],
            'employments.*.position'            => ['sometimes', 'required', 'string'],

            'emergency_contacts'                => ['sometimes', 'required', 'array'],
            'emergency_contacts.*.name'         => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.cellphone'    => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.relationship' => ['sometimes', 'required', 'string'],

            'insurance_policies'                       => ['required', 'array'],
            'insurance_policies.*.insurance_company'   => ['required', 'numeric'],
            'insurance_policies.*.policy_number'       => ['required', 'numeric'],
            'insurance_policies.*.insurance_plan'      => ['required', 'numeric'],
            'insurance_policies.*.copay'               => ['nullable', 'numeric'],
            'insurance_policies.*.group_number'        => ['nullable', 'numeric'],
            'insurance_policies.*.eff_date'            => ['required', 'date'],
            'insurance_policies.*.end_date'            => ['nullable', 'date'],
            'insurance_policies.*.release_info'        => ['required', 'boolean'],
            'insurance_policies.*.assign_benefits'     => ['required', 'boolean'],
            'insurance_policies.*.own_insurance'       => ['required', 'boolean'],

            'insurance_policies.*.subscriber'            => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.ssn'        => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.first_name' => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.last_name'  => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],

            'insurance_policies.*.subscriber.address'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.address.address' => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.city'    => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.state'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.zip'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            
            'insurance_policies.*.subscriber.contact'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.contact.phone'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.contact.fax'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.contact.email'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'email:rfc'],
        ];
    }
}
