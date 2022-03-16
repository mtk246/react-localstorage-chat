<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name'            => ['required', 'string', Rule::unique('clearing_houses', 'name')->ignore($this->clearing_id)],
            'org_type'        => ['required', 'string'],
            'ack_required'    => ['required', 'boolean'],
            
            'address'         => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city'    => ['required', 'string'],
            'address.state'   => ['required', 'string'],
            'address.zip'     => ['required', 'numeric'],
            
            'contact'         => ['required', 'array'],
            'contact.phone'   => ['required', 'string'],
            'contact.fax'     => ['nullable', 'string'],
            'contact.email'   => ['required', 'email:rfc'],
        ];
    }
}
