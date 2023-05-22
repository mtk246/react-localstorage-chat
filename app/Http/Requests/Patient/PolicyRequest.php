<?php

declare(strict_types=1);

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PolicyRequest extends FormRequest
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
            'billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'insurance_company' => ['required', 'numeric'],
            'policy_number' => ['required', 'string'],
            'insurance_plan' => ['required', 'numeric'],
            'group_number' => ['nullable', 'string'],
            'eff_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'type_responsibility_id' => ['required', 'integer'],
            'insurance_policy_type_id' => ['nullable', 'integer'],
            'release_info' => ['required', 'boolean'],
            'assign_benefits' => ['required', 'boolean'],
            'own_insurance' => ['required', 'boolean'],

            'subscriber' => ['nullable', 'required_if:own_insurance,false', 'array'],
            'subscriber.id' => ['nullable', 'integer'],
            'subscriber.relationship_id' => ['nullable', 'integer'],
            'subscriber.ssn' => ['nullable', 'string'],
            'subscriber.date_of_birth' => ['nullable', 'date'],
            'subscriber.name_suffix_id' => ['nullable', 'integer'],
            'subscriber.sex' => ['nullable', 'string', 'max:1'],
            'subscriber.first_name' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],
            'subscriber.last_name' => ['sometimes', 'required_if:own_insurance,false', 'nullable', 'string'],

            'subscriber.address' => ['nullable', 'array'],
            'subscriber.address.address' => ['nullable', 'string'],
            'subscriber.address.country' => ['nullable', 'string'],
            'subscriber.address.city' => ['nullable', 'string'],
            'subscriber.address.state' => ['nullable', 'string'],
            'subscriber.address.zip' => ['nullable', 'string'],

            'subscriber.contact' => ['nullable', 'array'],
            'subscriber.contact.phone' => ['nullable', 'string'],
            'subscriber.contact.mobile' => ['nullable', 'string'],
            'subscriber.contact.fax' => ['nullable', 'string'],
            'subscriber.contact.email' => ['nullable', 'email:rfc'],
        ];
    }
}
