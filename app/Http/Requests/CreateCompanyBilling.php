<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IUnique;
use App\Models\BillingCompany;

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
            'name'          => ['required', 'string', 'max:50', new IUnique(BillingCompany::class, 'name')],
            'address'       => ['nullable', 'array'],
            'contact'       => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.fax'   => ['nullable', 'string'],
            'contact.email' => ['required', 'email:rfc'],
            'logo'          => ['nullable', 'file', 'mimes:jpg,png', 'max:1024']
        ];
    }
}
