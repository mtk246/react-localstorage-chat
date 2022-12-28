<?php

namespace App\Http\Requests\ClaimSubStatus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ClaimSubStatus;

class ClaimSubStatusRequest extends FormRequest
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
            'code'                     => ['required', 'string'],
            'name'                     => ['required', 'string'],
            'description'              => ['nullable', 'string'],
            'claim_statuses'           => ['required', 'array'],
            'billing_companies'        => ['nullable', 'array'],
            'specific_billing_company' => ['nullable', 'boolean']
        ];
    }
}
