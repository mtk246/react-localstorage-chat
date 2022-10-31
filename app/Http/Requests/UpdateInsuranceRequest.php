<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\IUnique;
use App\Models\InsuranceCompany;

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
            'insurance'             => ['required', 'array'],
            'insurance.name'        => ['required', 'string'/**, new IUnique(InsuranceCompany::class, 'name', $this->id)*/],
            'insurance.naic'        => ['required', 'string'],
            'insurance.file_method' => ['required', 'string'],
            'insurance.nickname'    => ['sometimes', 'string'],

            'billing_company_id'    => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            
            'address'               => ['required', 'array'],
            'address.address'       => ['required', 'string'],
            'address.city'          => ['required', 'string'],
            'address.state'         => ['required', 'string'],
            'address.zip'           => ['required', 'string'],
            
            'contact'               => ['required', 'array'],
            'contact.phone'         => ['required', 'string'],
            'contact.fax'           => ['nullable', 'string'],
            'contact.email'         => ['required', 'email:rfc'],
        ];
    }
}
