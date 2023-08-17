<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Facility;
use App\Rules\CountInArray;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class FacilityCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<key, string> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', new IUnique(Facility::class, 'name')],
            'npi' => ['required', 'string'],
            'companies' => [
                'required',
                'array',
                'exists:\App\Models\Company,id',
            ],
            'nickname' => ['nullable', 'string'],
            'abbreviation' => ['string', 'max:20'],
            'place_of_services' => ['nullable', 'array'],

            'billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],

            'taxonomies' => [
                'required',
                'array',
                new CountInArray('primary', true, 1),
            ],
            'taxonomies.*.tax_id' => ['required', 'string'],
            'taxonomies.*.name' => ['required', 'string'],
            'taxonomies.*.primary' => ['required', 'boolean'],

            'address' => ['required', 'array'],
            'address.address' => [
                'required',
                'string',
                'doesnt_start_with:POB,pob',
            ],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.zip' => ['required', 'string'],
            'address.apt_suite' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.contact_name' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'email:rfc'],

            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
            'other_name' => ['nullable', 'string'],

            'types' => ['required', 'array'],
            'types.*.id' => ['required', 'integer', 'exists:\App\Models\FacilityType,id'],
            'types.*.bill_classifications' => ['required', 'array'],
            'types.*.bill_classifications.*' => [
                'required',
                'integer',
                'exists:\App\Models\BillClassification,id',
            ],
        ];
    }
}
