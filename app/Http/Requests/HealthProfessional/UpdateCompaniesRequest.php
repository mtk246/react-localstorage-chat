<?php

namespace App\Http\Requests\HealthProfessional;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompaniesRequest extends FormRequest
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
     * @return array <string, mixed>
     */
    public function rules()
    {
        return [
            'companies'                      => ['required', 'array'],
            'companies.*.billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'companies.*.company_id'         => ['required', 'integer'],
            'companies.*.authorization'      => ['nullable', 'array'],
        ];
    }
}
