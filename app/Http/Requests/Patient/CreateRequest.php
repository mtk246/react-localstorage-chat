<?php

namespace App\Http\Requests\Patient;

use App\Models\MaritalStatus;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class CreateRequest extends FormRequest
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
        $user = User::find($this->input('user_id') ?? null);
        return [
            'id' => ['nullable', 'integer'],
            'billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'driver_license' => ['nullable', 'string'],

            'profile' => ['required', 'array'],
            'profile.ssn' => [Rule::unique('profiles', 'ssn')->ignore($user->profile_id ?? null), 'nullable', 'string'],
            'profile.first_name' => ['required', 'string', 'max:20'],
            'profile.last_name' => ['required', 'string', 'max:20'],
            'profile.middle_name' => ['nullable', 'string', 'max:20'],
            'profile.name_suffix_id' => ['nullable', 'integer'],
            'profile.date_of_birth' => ['required', 'date'],
            'profile.sex' => ['required', 'string', 'max:1'],
            
            'marital_status_id' => ['nullable', 'integer'],
            'marital' => [
                Rule::requiredIf(function () {
                    $maritalStatus = MaritalStatus::find($this->input('marital_status_id'));
                    return (isset($maritalStatus) && $maritalStatus->name !== 'Single');
                }), 'nullable', 'array'],
            'marital.spuse_name' => [
                Rule::requiredIf(function () {
                    $maritalStatus = MaritalStatus::find($this->input('marital_status_id'));
                    return (isset($maritalStatus) && $maritalStatus->name !== 'Single');
                }), 'nullable', 'string'],
            'marital.spuse_work' => ['nullable', 'string'],
            'marital.spuse_work_phone' => ['nullable', 'string'],

            'company_id' => ['required', 'integer'],
            'company_med_num' => ['nullable', 'string'],

            'language' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', Rule::unique('users', 'email')->ignore($user->id ?? null), 'string', 'email:rfc'],

            'addresses' => ['required', 'array'],
            'addresses.*.address_type_id' => ['required', 'integer'],
            'addresses.*.address' => ['required', 'string'],
            'addresses.*.country' => ['required', 'string'],
            'addresses.*.city' => ['required', 'string'],
            'addresses.*.state' => ['required', 'string'],
            'addresses.*.zip' => ['required', 'string'],

            'guarantor' => ['nullable', 'array'],
            'guarantor.name' => ['nullable', 'string'],
            'guarantor.phone' => ['nullable', 'string'],

            'emergency_contacts' => ['nullable', 'array'],
            'emergency_contacts.*.name' => ['nullable', 'string'],
            'emergency_contacts.*.cellphone' => ['nullable', 'string'],
            'emergency_contacts.*.relationship_id' => ['nullable', 'integer'],

            'employments' => ['nullable', 'array'],
            'employments.*.employer_name' => ['nullable', 'string'],
            'employments.*.position' => ['nullable', 'string'],
            'employments.*.employer_address' => ['nullable', 'string'],
            'employments.*.employer_phone' => ['nullable', 'string'],

            'profile.social_medias' => ['nullable', 'array'],
            'profile.social_medias.*.name' => ['nullable', 'string'],
            'profile.social_medias.*.link' => ['nullable', 'string'],

            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
            'save_as_draft' => ['nullable', 'boolean'],
            'draft_note' => ['nullable', 'string']
        ];
    }
}
