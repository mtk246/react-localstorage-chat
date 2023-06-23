<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\BillingCompany;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyBilling extends FormRequest
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
            'tax_id' => ['required', 'string', 'unique:billing_companies'],
            'name' => ['required', 'string', 'max:50', new IUnique(BillingCompany::class, 'name')],
            'address' => ['nullable', 'array'],
            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', 'email:rfc'],
            'logo' => ['nullable', 'file', 'mimes:jpg,png', 'max:1024'],
            'abbreviation' => ['nullable', 'string'],
        ];
    }
}
