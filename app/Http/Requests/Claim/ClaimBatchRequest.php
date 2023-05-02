<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClaimBatchRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'claims_reconciled' => ['nullable', 'boolean'],
            'fake_transmission' => ['nullable', 'boolean'],
            'company_id' => ['required', 'integer'],
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'claim_ids' => ['required', 'array'],
            'send' => ['nullable', 'boolean'],
        ];
    }
}
