<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\HealthProfessional;

class UpdateDoctorRequest extends FormRequest
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
        $doctor = HealthProfessional::find($this->id);
        $user = $doctor->user;
        return [
            'npi'                   => ['required', 'string', Rule::unique('health_professionals', 'npi')->ignore($doctor->id)],
            'email'                 => ['required', Rule::unique('users', 'email')->ignore($user->id), 'string', 'email:rfc'],

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'health_professional_type_id' => ['integer', 'required'],
            'authorization'                            => ['nullable', 'array'],
            'taxonomies_company'           => ['required', 'array'],
            'taxonomies_company.*.tax_id'  => ['required', 'string'],
            'taxonomies_company.*.name'    => ['required', 'string'],
            'taxonomies_company.*.primary' => ['required', 'boolean'],

            'is_provider'          => ['nullable', 'boolean'],
            'npi_company'          => ['nullable', 'string'],
            'nickname'             => ['nullable', 'string'],

            'private_note'           => ['nullable', 'string'],
            'public_note'            => ['nullable', 'string'],

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

            'profile.social_medias'        => ['nullable', 'array'],
            'profile.social_medias.*.name' => ['nullable', 'string'],
            'profile.social_medias.*.link' => ['nullable', 'string'],

            'address'               => ['required', 'array'],
            'address.address'       => ['required', 'string'],
            'address.city'          => ['required', 'string'],
            'address.state'         => ['required', 'string'],
            'address.zip'           => ['required', 'string'],

            'contact'               => ['required', 'array'],
            'contact.phone'         => ['nullable', 'string'],
            'contact.mobile'        => ['nullable', 'string'],
            'contact.fax'           => ['nullable', 'string'],
            'contact.email'         => ['required', 'email:rfc'],
        ];
    }
}
