<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;

final class ClaimEligibilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'validate' => ['nullable', 'boolean'],
            'automatic_eligibility' => ['nullable', 'boolean'],
            'company_id' => ['required', 'integer'],
            'facility_id' => ['required', 'integer'],
            'patient_id' => ['required', 'integer'],

            'claim_services' => ['nullable', 'array'],
            'claim_services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.*.procedure_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.modifier_ids' => ['sometimes', 'nullable', 'array'],
            'claim_services.*.place_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.type_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.*.diagnostic_pointers' => ['sometimes', 'nullable', 'array'],
            'claim_services.*.days_or_units' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.copay' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.*.emg' => ['nullable', 'boolean'],
            'claim_services.*.epsdt_id' => ['nullable', 'integer'],
            'claim_services.*.family_planning_id' => ['nullable', 'integer'],
        ];
    }
}
