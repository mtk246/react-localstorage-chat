<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\HealthProfessional\HealthProfessionalType;
use App\Models\HealthProfessional;
use App\Rules\CountInArray;
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
        $doctorTypeId = HealthProfessionalType::MEDICAL_DOCTOR->value;
        $doctor = HealthProfessional::find($this->id);
        $user = $doctor->user;

        return [
            'npi' => [
                'required',
                'string',
                Rule::unique('health_professionals', 'npi')
                    ->ignore($doctor->id),
            ],
            'ein' => [
                Rule::requiredIf(!isset($this->profile['ssn'])),
                'string',
                'regex:/^\d{2}-\d{7}$/',
            ],
            'miscellaneous' => ['nullable', 'string', 'max:255'],

            'is_provider' => ['required', 'boolean'],

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'health_professional_type_id' => ['required', 'integer'],
            'company_id' => ['required', 'integer', 'nullable'],

            'authorization' => ['required', 'array'],
            'authorization.*' => ['required', 'integer'],

            'taxonomies' => [
                'required',
                'array',
                new CountInArray('primary', true, 1),
            ],
            'taxonomies.*.tax_id' => ['required', 'string'],
            'taxonomies.*.name' => ['required', 'string'],
            'taxonomies.*.primary' => ['required', 'boolean'],

            'nickname' => ['nullable', 'string'],

            'private_note' => ['nullable', 'string'],
            'public_note' => ['nullable', 'string'],

            'profile' => ['required', 'array'],
            'profile.sex' => ['required', 'string', 'max:1'],
            'profile.first_name' => ['required', 'string', 'max:20'],
            'profile.last_name' => ['required', 'string', 'max:20'],
            'profile.name_suffix_id' => ['nullable', 'integer'],
            'profile.middle_name' => ['nullable', 'string', 'max:20'],
            'profile.ssn' => [
                Rule::requiredIf(!isset($this->ein)),
                'string',
            ],
            'profile.date_of_birth' => ['required', 'date'],

            'profile.social_medias' => ['nullable', 'array'],
            'profile.social_medias.*.name' => ['nullable', 'string'],
            'profile.social_medias.*.link' => ['required_unless:profile.social_medias.*.name,null', 'nullable', 'string'],

            'address' => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.apt_suite' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => [
                Rule::requiredIf($this->create_user),
                'email:rfc',
            ],

            'create_user' => ['required', 'boolean'],
        ];
    }
}
