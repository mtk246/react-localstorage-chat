<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\IUnique;
use App\Models\Company;

class CompanyCreateRequest extends FormRequest
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
            'name'                 => ['required', 'string', new IUnique(Company::class, 'name')],
            'npi'                  => ['required', 'integer'],
            'nickname'             => ['sometimes', 'string'],
            
            'billing_company_id'   => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],

            'taxonomies'           => ['required', 'array'],
            'taxonomies.*.tax_id'  => ['required', 'string'],
            'taxonomies.*.name'    => ['required', 'string'],
            'taxonomies.*.primary' => ['required', 'boolean'],

            'address'              => ['required', 'array'],
            'address.address'      => ['required', 'string'],
            'address.city'         => ['required', 'string'],
            'address.state'        => ['required', 'string'],
            'address.zip'          => ['required', 'string'],
            
            'contact'              => ['required', 'array'],
            'contact.phone'        => ['required', 'string'],
            'contact.fax'          => ['nullable', 'string'],
            'contact.email'        => ['required', 'email:rfc'],
        ];
    }
}
