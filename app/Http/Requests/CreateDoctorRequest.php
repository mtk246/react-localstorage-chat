<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDoctorRequest extends FormRequest
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
            'npi'                   => ['required', 'string', Rule::unique('health_professionals', 'npi')],
            'email'                 => ['required', Rule::unique('users', 'email'), 'string', 'email:rfc'],

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'health_professional_type_id' => ['integer', 'required'],
            'authorization_id'     => ['integer', 'nullable'],

            'taxonomies'           => ['required', 'array'],
            'taxonomies.*.tax_id'  => ['required', 'string'],
            'taxonomies.*.name'    => ['required', 'string'],
            'taxonomies.*.primary' => ['required', 'boolean'],

            'profile'               => ['required', 'array'],
            'profile.sex'           => ['required', 'string', 'max:1'],
            'profile.first_name'    => ['required', 'string', 'max:20'],
            'profile.last_name'     => ['required', 'string', 'max:20'],
            'profile.middle_name'   => ['nullable', 'string', 'max:20'],
            'profile.ssn'           => ['required', 'string'],
            'profile.date_of_birth' => ['required', 'date'],

            'profile.social_medias' => ['sometimes', 'array'],
            'profile.social_medias.*.name' => ['sometimes', 'string'],
            'profile.social_medias.*.link' => ['sometimes', 'string'],

            'address'               => ['required', 'array'],
            'address.address'       => ['required', 'string'],
            'address.city'          => ['required', 'string'],
            'address.state'         => ['required', 'string'],
            'address.zip'           => ['required', 'string'],

            'contact'               => ['required', 'array'],
            'contact.phone'         => ['required', 'string'],
            'contact.fax'           => ['required', 'string'],
            'contact.email'         => ['required', 'email:rfc'],
        ];
    }
}
