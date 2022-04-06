<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IpRestrictionRequest extends FormRequest
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
            'ip_beginning'       => ['required', 'string'],
            'ip_finish'          => ['nullable', 'string'],
            'rank'               => ['required', 'boolean'],
            'billing_company_id' => ['nullable', 'numeric'],

            'users'              => ['sometimes', 'array'],
            'roles'              => ['sometimes', 'array'],
        ];
    }
}
