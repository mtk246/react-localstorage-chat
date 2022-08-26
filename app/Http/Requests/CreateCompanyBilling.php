<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            //'name'          => ['required', 'string', 'max:50', Rule::unique('billing_companies', 'name')],
            'name'          => ['required', 'string', 'max:50', new IUnique(BillingCompany::class, 'name')],
            'address'       => ['sometimes', 'array'],
            'contact'       => ['required', 'array'],
            'contact.email' => ['required', 'email:rfc'],
        ];
    }
}
