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

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')),'integer', 'nullable'],

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
            'contact.email'                     => ['required', 'email:rfc'],

            'marital'                           => ['sometimes', 'required', 'array'],
            'marital.spuse_name'                => ['sometimes', 'required', 'string'],
            'marital.spuse_work'                => ['sometimes', 'required', 'string'],
            'marital.spuse_work_phone'          => ['sometimes', 'required', 'string'],

            
            'guarantor'                         => ['sometimes', 'required', 'array'],
            'guarantor.name'                    => ['sometimes', 'required', 'string'],
            'guarantor.phone'                   => ['sometimes', 'required', 'string'],

            'employment'                          => ['sometimes', 'required', 'array'],
            'employment.*.employer_name'          => ['sometimes', 'required', 'string'],
            'employment.*.employer_address'       => ['sometimes', 'required', 'string'],
            'employment.*.employer_phone'         => ['sometimes', 'required', 'string'],
            'employment.*.position'               => ['sometimes', 'required', 'string'],

            'emergency_contacts'                => ['sometimes', 'required', 'array'],
            'emergency_contacts.*.name'         => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.cellphone'    => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.relationship' => ['sometimes', 'required', 'string'],

            'insurance_policies'                       => ['required', 'array'],
            'insurance_policies.*.insurance_company'   => ['required', 'numeric'],
            'insurance_policies.*.insurance_plan'      => ['required', 'numeric'],
            'insurance_policies.*.own_insurance'       => ['required', 'boolean'],

            'insurance_policies.*.suscriber'            => ['sometimes', 'required', 'array'],
            'insurance_policies.*.suscriber.ssn'        => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.first_name' => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.last_name'  => ['sometimes', 'required', 'string'],

            'insurance_policies.*.suscriber.address'         => ['sometimes', 'required', 'array'],
            'insurance_policies.*.suscriber.address.address' => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.address.city'    => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.address.state'   => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.address.zip'     => ['sometimes', 'required', 'numeric'],
            
            'insurance_policies.*.suscriber.contact'         => ['sometimes', 'required', 'array'],
            'insurance_policies.*.suscriber.contact.phone'   => ['sometimes', 'required', 'string'],
            'insurance_policies.*.suscriber.contact.fax'     => ['sometimes', 'nullable', 'string'],
            'insurance_policies.*.suscriber.contact.email'   => ['sometimes', 'required', 'email:rfc'],
        ];
    }
}
