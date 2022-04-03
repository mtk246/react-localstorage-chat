<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'credit_score'                      => ['nullable', 'string'],
            'own_insurance'                     => ['required', 'string'],
            'public_note'                       => ['sometimes', 'required', 'string'],
            'private_note'                      => ['required', 'string'],

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

            'employment'                        => ['sometimes', 'required', 'array'],
            'employment.employer_name'          => ['sometimes', 'required', 'string'],
            'employment.employer_address'       => ['sometimes', 'required', 'string'],
            'employment.employer_phone'         => ['sometimes', 'required', 'string'],
            'employment.position'               => ['sometimes', 'required', 'string'],

            'emergency_contacts'                => ['sometimes', 'required', 'array'],
            'emergency_contacts.*.name'         => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.cellphone'    => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.relationship' => ['sometimes', 'required', 'string'],

            'suscriber'                         => ['required', 'array'],
            'suscriber.ssn'                     => ['required', 'string'],
            'suscriber.email'                   => ['required', 'string'],
            'suscriber.first_name'              => ['required', 'string'],
            'suscriber.last_name'               => ['required', 'string'],
            'suscriber.address'                 => ['required', 'string'],
            'suscriber.phone'                   => ['required', 'string'],
        ];
    }
}
