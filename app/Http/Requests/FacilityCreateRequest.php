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
            'facility_type_id' => ['required', 'integer'],
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
            'address.address' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.zip' => ['required', 'string'],

            'contact' => ['required', 'array'],
            'contact.contact_name' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'email:rfc'],
        ];
    }
}
