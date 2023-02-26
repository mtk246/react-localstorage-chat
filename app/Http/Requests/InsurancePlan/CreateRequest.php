<?php

namespace App\Http\Requests\InsurancePlan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\IUnique;
use App\Models\InsurancePlan;

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
        return [
            'billing_company_id'   => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'insurance_company_id' => ['required', 'integer'],
            'name'                 => ['required', 'string', new IUnique(InsurancePlan::class, 'name')],
            'nickname'             => ['nullable', 'string'],
            'ins_type_id'          => ['required', 'integer'],
            'plan_type_id'         => ['nullable', 'integer'],
            'abbreviation'         => ['nullable', 'string'],
            'eff_date'             => ['required', 'date'],
            'charge_using_id'      => ['nullable', 'integer'],

            'accept_assign'        => ['required', 'boolean'],
            'pre_authorization'    => ['required', 'boolean'],
            'file_zero_changes'    => ['required', 'boolean'],
            'referral_required'    => ['required', 'boolean'],
            'accrue_patient_resp'  => ['required', 'boolean'],
            'require_abn'          => ['required', 'boolean'],
            'pqrs_eligible'        => ['required', 'boolean'],
            'allow_attached_files' => ['required', 'boolean'],

            'format_professional_id'  => ['required', 'integer'],
            'format_cms_id'           => ['required', 'integer'],
            'format_institutional_id' => ['required', 'integer'],
            'format_ub_id'            => ['required', 'integer'],
            'file_method_id'          => ['nullable', 'integer'],
            'naic'                    => ['nullable', 'string'],

            'time_failed'              => ['nullable', 'array'],
            'time_failed.days'         => ['nullable', 'integer'],
            'time_failed.from_id'      => ['nullable', 'integer'],

            'address'               => ['nullable', 'array'],
            'address.address'       => ['nullable', 'string'],
            'address.city'          => ['nullable', 'string'],
            'address.state'         => ['nullable', 'string'],
            'address.zip'           => ['nullable', 'string'],
            'address.country'       => ['nullable', 'string'],
            'address.country_subdivision_code' => ['nullable', 'string'],

            'contact'               => ['nullable', 'array'],
            'contact.phone'         => ['nullable', 'string'],
            'contact.mobile'        => ['nullable', 'string'],
            'contact.fax'           => ['nullable', 'string'],
            'contact.email'         => ['nullable', 'email:rfc'],
            'contact.contact_name'  => ['nullable', 'string'],

            'private_note'          => ['nullable', 'string'],
            'public_note'           => ['nullable', 'string']
        ];
    }
}
