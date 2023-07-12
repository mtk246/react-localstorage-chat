<?php

declare(strict_types=1);

namespace App\Http\Requests\Facility;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class AddCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'companies' => ['required', 'array'],
            'companies.*.billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'companies.*.company_id' => [
                'required', 
                'integer',
                'exists:\App\Models\Company,id',
            ],
        ];
    }
}
