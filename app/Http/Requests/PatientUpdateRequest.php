<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Patient;

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
        $id = $this->route('id');
        $patient = Patient::find($id);
        return [
            'billing_company_id'                => [Rule::requiredIf(auth()->user()->hasRole('superuser')),'integer', 'nullable'],
            'driver_license'                    => ['nullable', 'string'],

            'profile'                           => ['required', 'array'],
            'profile.ssn'                       => ['nullable', 'string'],
            'profile.first_name'                => ['required', 'string', 'max:20'],
            'profile.last_name'                 => ['required', 'string', 'max:20'],
            'profile.middle_name'               => ['nullable', 'string', 'max:20'],
            'profile.date_of_birth'             => ['required', 'date'],
            'profile.sex'                       => ['required', 'string', 'max:1'],
            
            'marital_status_id'                 => ['nullable', 'integer'],
            'marital'                           => ['nullable', 'array'],
            'marital.spuse_name'                => ['nullable', 'string'],
            'marital.spuse_work'                => ['nullable', 'string'],
            'marital.spuse_work_phone'          => ['nullable', 'string'],

            'companies'                         => ['nullable', 'array'],
            'companies.*.company_id'            => ['nullable', 'integer'],
            'companies.*.med_num'               => ['nullable', 'string'],

            'language'                          => ['nullable', 'string'],

            'contact'                           => ['required', 'array'],
            'contact.phone'                     => ['nullable', 'string'],
            'contact.mobile'                    => ['nullable', 'string'],
            'contact.fax'                       => ['nullable', 'string'],
            'contact.email'                     => ['required', Rule::unique('users', 'email')->ignore($patient->user_id), 'string', 'email:rfc'],

            'addresses'                           => ['required', 'array'],
            'addresses.*.address_type_id'         => ['required', 'integer'],
            'addresses.*.address'                 => ['required', 'string'],
            'addresses.*.city'                    => ['required', 'string'],
            'addresses.*.state'                   => ['required', 'string'],
            'addresses.*.zip'                     => ['required', 'string'],

            'insurance_policies'                       => ['required', 'array'],
            'insurance_policies.*.policy_number'       => ['required', 'numeric'],
            'insurance_policies.*.group_number'        => ['nullable', 'numeric'],
            'insurance_policies.*.insurance_company'   => ['required', 'integer'],
            'insurance_policies.*.insurance_plan'      => ['required', 'integer'],
            'insurance_policies.*.type_responsibility_id'      => ['required', 'integer'],
            'insurance_policies.*.insurance_policy_type_id'      => ['nullable', 'integer'],
            'insurance_policies.*.eff_date'            => ['required', 'date'],
            'insurance_policies.*.end_date'            => ['nullable', 'date'],
            'insurance_policies.*.assign_benefits'     => ['required', 'boolean'],
            'insurance_policies.*.release_info'        => ['required', 'boolean'],
            'insurance_policies.*.own_insurance'       => ['required', 'boolean'],

            'insurance_policies.*.subscriber'            => ['nullable', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.relationship_id'  => ['nullable', 'integer'],
            'insurance_policies.*.subscriber.ssn'        => ['nullable', 'required_if:insurance_policies.*.own_insurance,false', 'string'],
            'insurance_policies.*.subscriber.date_of_birth'  => ['nullable', 'date'],
            'insurance_policies.*.subscriber.first_name' => ['nullable', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.last_name'  => ['nullable', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],

            'insurance_policies.*.subscriber.address'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.address.address' => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.city'    => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.state'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.address.zip'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            
            'insurance_policies.*.subscriber.contact'         => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'array'],
            'insurance_policies.*.subscriber.contact.phone'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.contact.mobile'  => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.contact.fax'     => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'string'],
            'insurance_policies.*.subscriber.contact.email'   => ['sometimes', 'required_if:insurance_policies.*.own_insurance,false', 'nullable', 'email:rfc'],

            'guarantor'                         => ['nullable', 'array'],
            'guarantor.name'                    => ['nullable', 'string'],
            'guarantor.phone'                   => ['nullable', 'string'],

            'emergency_contacts'                => ['nullable', 'array'],
            'emergency_contacts.*.name'         => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.cellphone'    => ['sometimes', 'required', 'string'],
            'emergency_contacts.*.relationship_id' => ['sometimes', 'required', 'integer'],

            'employments'                       => ['nullable', 'array'],
            'employments.*.employer_name'       => ['sometimes', 'required', 'string'],
            'employments.*.position'            => ['sometimes', 'required', 'string'],
            'employments.*.employer_address'    => ['sometimes', 'required', 'string'],
            'employments.*.employer_phone'      => ['sometimes', 'required', 'string'],


            'profile.social_medias'             => ['nullable', 'array'],
            'profile.social_medias.*.name'      => ['sometimes', 'required', 'string'],
            'profile.social_medias.*.link'      => ['sometimes', 'required', 'string'],

            'public_note'                       => ['sometimes', 'required', 'string'],
            'private_note'                      => ['sometimes', 'required', 'string'],
            'save_as_draft' => ['nullable', 'boolean']
        ];
    }
}
