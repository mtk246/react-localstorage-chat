<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\UpdateContactDataRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class UpdateContactDataRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = UpdateContactDataRequestCast::class;

    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
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
            'address.apt_suite' => ['nullable', 'string'],

            'payment_address' => ['nullable', 'array'],
            'payment_address.address' => ['nullable', 'string'],
            'payment_address.city' => ['nullable', 'string'],
            'payment_address.state' => ['nullable', 'string'],
            'payment_address.zip' => ['nullable', 'string'],
            'payment_address.country' => ['nullable', 'string'],
            'payment_address.apt_suite' => ['nullable', 'string'],
        ];
    }
}
