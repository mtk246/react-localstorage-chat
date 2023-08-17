<?php

declare(strict_types=1);

namespace App\Http\Requests\BillingCompany;

use App\Models\BillingCompany;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBillingCompanyRequest extends FormRequest
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
            'tax_id' => [
                'required',
                'string',
                'max:50',
                new IUnique(BillingCompany::class, 'tax_id', $this->route('billing_company')),
            ],
            'name' => [
                'required', 'string', 'max:50',
                new IUnique(BillingCompany::class, 'name', $this->route('billing_company')),
            ],
            'address' => ['nullable', 'array'],
            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => [
                'required',
                'email:rfc',
                Rule::unique('contacts', 'email')->ignore($this->route('billing_company'), 'billing_company_id'),
            ],
            'contact.contact_name' => ['nullable', 'string'],
            'abbreviation' => ['nullable', 'string'],
        ];
    }
}
