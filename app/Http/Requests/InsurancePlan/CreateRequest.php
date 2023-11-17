<?php

declare(strict_types=1);

namespace App\Http\Requests\InsurancePlan;

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
        return [
            'billing_company_id' => [Rule::requiredIf(Gate::check('is-admin')), 'integer', 'nullable'],
            'payer_id' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string'],
            'abbreviation' => ['nullable', 'string'],
            'insurance_company_id' => ['required', 'integer'],
            'ins_type_id' => ['required', 'integer'],
            'plan_type_ids' => ['nullable', 'array'],
            'plan_type_ids.*' => [
                'integer',
                'exists:\App\Models\TypeCatalog,id',
            ],
            'eff_date' => ['nullable', 'date'],

            'accept_assign' => ['required', 'boolean'],
            'pre_authorization' => ['required', 'boolean'],
            'file_zero_changes' => ['required', 'boolean'],
            'referral_required' => ['required', 'boolean'],
            'accrue_patient_resp' => ['required', 'boolean'],
            'require_abn' => ['required', 'boolean'],
            'pqrs_eligible' => ['required', 'boolean'],
            'allow_attached_files' => ['required', 'boolean'],

            'naic' => ['nullable', 'string'],
            'file_method_id' => ['nullable', 'integer'],

            'format' => ['required', 'array'],
            'format.*.format_professional_id' => ['required', 'integer'],
            'format.*.format_cms_id' => ['required', 'integer'],
            'format.*.format_institutional_id' => ['required', 'integer'],
            'format.*.format_ub_id' => ['required', 'integer'],
            'format.*.responsibilities' => ['required', 'array'],
            'format.*.responsibilities.*' => [
                'required',
                'integer',
                'exists:\App\Models\TypeCatalog,id',
            ],

            'time_failed' => ['nullable', 'array'],
            'time_failed.days' => ['nullable', 'integer'],
            'time_failed.from_id' => ['nullable', 'integer'],

            'address' => ['nullable', 'array'],
            'address.address' => ['nullable', 'string'],
            'address.apt_suite' => ['nullable', 'string'],
            'address.country' => ['nullable', 'string'],
            'address.zip' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],

            'contact' => ['nullable', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'email:rfc'],
            'contact.contact_name' => ['nullable', 'string'],

            'private_note' => ['nullable', 'string'],
            'public_note' => ['nullable', 'string'],
        ];
    }
}
