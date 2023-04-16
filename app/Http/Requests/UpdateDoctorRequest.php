<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\HealthProfessional;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $doctorTypeId = HealthProfessionalType::whereType('Medical doctor')->first('id');
        $doctor = HealthProfessional::find($this->id);
        $user = $doctor->user;

        return [
            'npi' => [
                'required',
                'string',
                Rule::unique('health_professionals', 'npi')
                    ->ignore($doctor->id),
            ],
            'ein' => ['nullable', 'string', 'regex:/^\d{2}-\d{7}$/'],
            'upin' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
                'string',
                'email:rfc',
            ],

            'is_provider' => ['nullable', 'boolean'],

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'health_professional_type_id' => ['required', 'integer'],
            'company_id' => ['required_unless:is_provider,true', 'integer', 'nullable'],
            'authorization' => [
                Rule::requiredIf(
                    !$this->is_provider
                    && $doctorTypeId->id == $this->health_professional_type_id
                ),
                'array',
                'nullable',
            ],

            'taxonomies_company' => ['required_unless:npi_company,null', 'array', 'nullable'],
            'taxonomies_company.*.tax_id' => ['required_unless:npi_company,null', 'string', 'nullable'],
            'taxonomies_company.*.name' => ['required_unless:npi_company,null', 'string', 'nullable'],
            'taxonomies_company.*.primary' => ['required_unless:npi_company,null', 'boolean', 'nullable'],

            'npi_company' => ['nullable', 'string'],
            'name_company' => ['required_unless:npi_company,null', 'nullable', 'string'],
            'nickname' => ['nullable', 'string'],

            'private_note' => ['nullable', 'string'],
            'public_note' => ['nullable', 'string'],

            'taxonomies' => ['required', 'array'],
            'taxonomies.*.tax_id' => ['required', 'string'],
            'taxonomies.*.name' => ['required', 'string'],
            'taxonomies.*.primary' => ['required', 'boolean'],

            'profile' => ['required', 'array'],
            'profile.sex' => ['required', 'string', 'max:1'],
            'profile.first_name' => ['required', 'string', 'max:20'],
            'profile.last_name' => ['required', 'string', 'max:20'],
            'profile.name_suffix_id' => ['nullable', 'integer'],
            'profile.middle_name' => ['nullable', 'string', 'max:20'],
            'profile.ssn' => ['nullable', 'string'],
            'profile.date_of_birth' => ['required', 'date'],

            'profile.social_medias' => ['nullable', 'array'],
            'profile.social_medias.*.name' => ['nullable', 'string'],
            'profile.social_medias.*.link' => ['required_unless:profile.social_medias.*.name,null', 'nullable', 'string'],

            'address' => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],

            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', 'email:rfc'],
        ];
    }
}
