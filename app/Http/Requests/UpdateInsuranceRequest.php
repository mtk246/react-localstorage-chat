<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\InsuranceCompany\NameUniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInsuranceRequest extends FormRequest
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
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'insurance' => ['required', 'array'],
            'insurance.payer_id' => ['required', 'string', 'max:20'],
            'insurance.name' => ['required', 'string', new NameUniqueRule($this->input('insurance.payer_id', (int) $this->route('id')))],
            'insurance.abbreviation' => ['required', 'string', 'max:20'],
            'insurance.naic' => ['nullable', 'string'],
            'insurance.file_method_id' => ['required', 'integer'],
            'insurance.nickname' => ['nullable', 'string', 'max:100'],

            'time_failed' => ['nullable', 'array'],
            'time_failed.days' => ['nullable', 'integer'],
            'time_failed.from_id' => ['nullable', 'integer'],

            'address' => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.apt_suite' => ['nullable', 'string'],

            'contact' => ['nullable', 'array'],
            'contact.phone' => ['required', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'email:rfc'],
            'contact.contact_name' => ['nullable', 'string'],

            'billing_incomplete_reasons' => ['nullable', 'array'],
            'appeal_reasons' => ['nullable', 'array'],
            'public_note' => ['nullable', 'string'],
            'private_note' => ['nullable', 'string'],
        ];
    }
}
