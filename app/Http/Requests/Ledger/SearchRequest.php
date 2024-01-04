<?php

declare(strict_types=1);

namespace App\Http\Requests\Ledger;

use Illuminate\Foundation\Http\FormRequest;

final class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        if (empty($this->all())) {
            abort(400, 'Error, You must provide at least 1 search parameter');
        }

        return [
            'claim_number' => 'nullable|string',

            'company_ids' => 'nullable|array',
            'company_ids.*' => 'nullable|integer',
            'dob' => 'nullable|string',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'first_name' => 'nullable|string',

            'health_professional_ids' => 'nullable|array',
            'health_professional_ids.*' => 'nullable|integer',

            'insurance_plans_ids' => 'nullable|array',
            'insurance_plans_ids.*' => 'nullable|integer',
            'last_name' => 'nullable|string',
            'medical_number' => 'nullable|string',
            'patient_number' => 'nullable|string',
            'ssn' => 'nullable|string',

            'start_date' => 'nullable|date|before_or_equal:end_date',
        ];
    }
}
