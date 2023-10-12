<?php

declare(strict_types=1);

namespace App\Http\Requests\Patient;

use App\Models\MaritalStatus;
use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $patient = Patient::query()->find($this->route('id'));

        return [
            'billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'driver_license' => ['nullable', 'string'],
            'create_user' => ['required', 'boolean'],

            'profile' => ['required', 'array'],
            'profile.ssn' => [Rule::unique('profiles', 'ssn')->ignore($patient->profile_id ?? null), 'nullable', 'string'],
            'profile.first_name' => ['required', 'string', 'max:20'],
            'profile.last_name' => ['required', 'string', 'max:20'],
            'profile.middle_name' => ['nullable', 'string', 'max:20'],
            'profile.name_suffix_id' => ['nullable', 'integer'],
            'profile.date_of_birth' => ['required', 'date'],
            'profile.sex' => ['required', 'string', 'max:1'],
            'profile.deceased_date' => ['nullable', 'date'],

            'marital_status_id' => ['nullable', 'integer'],
            'marital' => [
                Rule::requiredIf(function () {
                    $maritalStatus = MaritalStatus::find($this->input('marital_status_id'));

                    return isset($maritalStatus) && 'Single' !== $maritalStatus->name;
                }), 'nullable', 'array'],
            'marital.spuse_name' => [
                Rule::requiredIf(function () {
                    $maritalStatus = MaritalStatus::find($this->input('marital_status_id'));

                    return isset($maritalStatus) && 'Single' !== $maritalStatus->name;
                }), 'nullable', 'string'],
            'marital.spuse_work' => ['nullable', 'string'],
            'marital.spuse_work_phone' => ['nullable', 'string'],

            'language' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => [
                Rule::requiredIf(fn () => (bool) $this->input('create_user')),
                'nullable',
                Rule::unique('users', 'email')->ignore($patient->user?->id ?? null),
                'string',
                'email:rfc',
            ],

            'addresses' => ['required', 'array'],
            'addresses.*.address_type_id' => ['required', 'integer'],
            'addresses.*.address' => ['required', 'string'],
            'addresses.*.country' => ['required', 'string'],
            'addresses.*.city' => ['required', 'string'],
            'addresses.*.state' => ['required', 'string'],
            'addresses.*.zip' => ['required', 'string', 'regex:/^.{5}$|^.{9}$/'],
            'addresses.*.apt_suite' => ['nullable', 'string'],
            'addresses.*.main_address' => ['nullable', 'boolean'],

            'guarantor' => ['nullable', 'array'],
            'guarantor.name' => ['nullable', 'string'],
            'guarantor.phone' => ['nullable', 'string'],

            'emergency_contacts' => ['nullable', 'array'],
            'emergency_contacts.*.name' => [
                'required_with:emergency_contacts.*.cellphone,emergency_contacts.*.relationship_id',
                'nullable',
                'string',
            ],
            'emergency_contacts.*.cellphone' => [
                'required_with:emergency_contacts.*.name,emergency_contacts.*.relationship_id',
                'nullable',
                'string',
            ],
            'emergency_contacts.*.relationship_id' => [
                'required_with:emergency_contacts.*.name,emergency_contacts.*.cellphone',
                'nullable',
                'integer',
            ],

            'employments' => ['nullable', 'array'],
            'employments.*.employer_name' => [
                'required_with:employments.*.position,employments.*.employer_address,employments.*.employer_phone',
                'nullable',
                'string',
            ],
            'employments.*.position' => [
                'required_with:employments.*.employer_name,employments.*.employer_address,employments.*.employer_phone',
                'nullable',
                'string',
            ],
            'employments.*.employer_address' => [
                'required_with:employments.*.position,employments.*.employer_name,employments.*.employer_phone',
                'nullable',
                'string',
            ],
            'employments.*.employer_phone' => [
                'required_with:employments.*.position,employments.*.employer_address,employments.*.employer_name',
                'nullable',
                'string',
            ],

            'profile.social_medias' => ['nullable', 'array'],
            'profile.social_medias.*.name' => [
                'required_with:profile.social_medias.*.link',
                'nullable',
                'string',
            ],
            'profile.social_medias.*.link' => [
                'required_with:profile.social_medias.*.name',
                'nullable',
                'string',
            ],

            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
            'save_as_draft' => ['nullable', 'boolean'],
            'draft_note' => ['nullable', 'string'],
        ];
    }
}
