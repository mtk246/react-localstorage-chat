<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class ClaimEligibilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],

            'claim_services' => ['nullable', 'array'],
            'claim_services.services' => ['array', 'nullable'],
            'claim_services.services.*.copay' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.days_or_units' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.diagnostic_pointers' => ['sometimes', 'nullable', 'array'],
            'claim_services.services.*.emg' => ['nullable', 'boolean'],
            'claim_services.services.*.epsdt_id' => ['nullable', 'integer'],
            'claim_services.services.*.family_planning_id' => ['nullable', 'integer'],
            'claim_services.services.*.from_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.id' => ['nullable', 'integer'],
            'claim_services.services.*.modifier_ids' => ['sometimes', 'nullable', 'array'],
            'claim_services.services.*.place_of_service_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.services.*.price' => ['sometimes', 'nullable', 'numeric'],
            'claim_services.services.*.procedure_id' => ['sometimes', 'nullable', 'integer'],
            'claim_services.services.*.to_service' => ['sometimes', 'nullable', 'date'],
            'claim_services.services.*.type_of_service_id' => ['sometimes', 'nullable', 'integer'],

            'demographic_information' => ['required', 'array'],
            'demographic_information.automatic_eligibility' => ['nullable', 'boolean'],
            'demographic_information.company_id' => ['required', 'integer'],
            'demographic_information.facility_id' => ['required', 'integer'],
            'demographic_information.patient_id' => ['required', 'integer'],
            'demographic_information.validate' => ['nullable', 'boolean'],
            'type' => ['required', 'integer'],
        ];
    }
}
