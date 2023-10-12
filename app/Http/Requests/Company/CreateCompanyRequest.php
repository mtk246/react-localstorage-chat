<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class CreateCompanyRequest extends FormRequest
{
    /** @return array<string, mixed> */
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
            'clia' => ['nullable', 'string', 'max:50'],
            'other_name' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string'],
            'abbreviation' => ['nullable', 'string', 'max:20'],
            'miscellaneous' => ['nullable', 'string', 'max:255'],
            'claim_format_ids' => ['required', 'array'],
            'split_company_claim' => ['nullable', 'boolean'],

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
            'address.address' => [
                'required',
                'string',
                'doesnt_start_with:POB,pob,Post Office Box,P.O. Box,PO Box,P O Box,P. O. BOX,PO  BOX,Lock Box,Lock Bin,LOCKBOX,DRAWER,P O. Box,PO. Box,P. O Box,PO   BOX,P.O.  Box,P O  Box,PO BX,PO B OX,PO B',
            ],
            'address.apt_suite' => ['nullable', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],
            'address.country' => ['required', 'string'],

            'payment_address' => ['nullable', 'array'],
            'payment_address.address' => ['sometimes', 'string'],
            'payment_address.apt_suite' => ['nullable', 'string'],
            'payment_address.city' => ['sometimes', 'string'],
            'payment_address.state' => ['sometimes', 'string'],
            'payment_address.zip' => ['sometimes', 'string'],
            'payment_address.country' => ['sometimes', 'string'],

            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
        ];
    }
}
