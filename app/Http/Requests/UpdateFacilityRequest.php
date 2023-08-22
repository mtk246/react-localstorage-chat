<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Facility;
use App\Rules\AddressValidationRule;
use App\Rules\CountInArray;
use App\Rules\IUnique;
use App\Rules\PhoneFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFacilityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', new IUnique(Facility::class, 'name', $this->id)],
            'npi' => ['required', 'string'],
            'companies' => [
                'required',
                'array',
                'exists:\App\Models\Company,id',
            ],
            'nickname' => ['nullable', 'string'],
            'abbreviation' => ['required', 'string', 'max:20'],
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
                new AddressValidationRule(),
            ],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.zip' => ['nullable', 'string'],
            'address.apt_suite' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.contact_name' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string', new PhoneFormat()],
            'contact.mobile' => ['nullable', 'string', new PhoneFormat()],
            'contact.fax' => ['nullable', 'string', new PhoneFormat()],
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
