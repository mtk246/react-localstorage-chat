<?php

declare(strict_types=1);

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeStatusPolicyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'status' => ['required', 'boolean'],
        ];
    }
}
