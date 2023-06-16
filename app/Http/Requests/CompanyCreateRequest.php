<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Company\ApplyToType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CompanyCreateRequest extends FormRequest
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
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'npi' => ['required', 'integer'],
            'ein' => ['nullable', 'string', 'regex:/^\d{2}-\d{7}$/'],
            'upin' => ['nullable', 'string', 'max:50'],
            'clia' => ['nullable', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string'],
            'name_suffix_id' => ['nullable', 'integer'],
            'abbreviation' => ['nullable', 'string', 'max:20'],

            'taxonomies' => ['nullable', 'array'],
            'taxonomies.*.tax_id' => ['sometimes', 'string'],
            'taxonomies.*.name' => ['sometimes', 'string'],
            'taxonomies.*.primary' => ['sometimes', 'boolean'],

            'contact' => ['required', 'array'],
            'contact.contact_name' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', 'email:rfc'],

            'address' => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],
            'address.country' => ['nullable', 'string'],
            'address.country_subdivision_code' => ['nullable', 'string'],

            'payment_address' => ['nullable', 'array'],
            'payment_address.address' => ['sometimes', 'string'],
            'payment_address.city' => ['sometimes', 'string'],
            'payment_address.state' => ['sometimes', 'string'],
            'payment_address.zip' => ['sometimes', 'string'],
            'payment_address.country' => ['nullable', 'string'],
            'payment_address.country_subdivision_code' => ['nullable', 'string'],

            'statements' => ['nullable', 'array'],
            'statements.*.rule_id' => ['nullable', 'integer'],
            'statements.*.when_id' => ['nullable', 'integer'],
            'statements.*.apply_to_ids' => ['nullable', 'array'],
            'statements.*.apply_to_ids.*' => ['integer', new Enum(ApplyToType::class)],
            'statements.*.start_date' => ['nullable', 'date'],
            'statements.*.end_date' => ['nullable', 'date'],

            'exception_insurance_companies' => ['nullable', 'array'],

            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
        ];
    }
}
