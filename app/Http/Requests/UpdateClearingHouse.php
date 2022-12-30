<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\IUnique;
use App\Models\ClearingHouse;

class UpdateClearingHouse extends FormRequest
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
            'name'               => ['required', 'string', new IUnique(ClearingHouse::class, 'name', $this->clearing_id)],
            'org_type'           => ['required', 'string'],
            'ack_required'       => ['required', 'boolean'],
            'nickname'           => ['sometimes', 'string'],
            'transmission_format_id' => ['required', 'integer'],

            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            
            'address'            => ['required', 'array'],
            'address.address'    => ['required', 'string'],
            'address.city'       => ['required', 'string'],
            'address.state'      => ['required', 'string'],
            'address.zip'        => ['required', 'string'],
            
            'contact'            => ['required', 'array'],
            'contact.phone'      => ['required', 'string'],
            'contact.fax'        => ['nullable', 'string'],
            'contact.email'      => ['required', 'email:rfc'],
        ];
    }
}
