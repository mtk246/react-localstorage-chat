<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ServiceRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\Company\DuplicityServiceValidation;
use App\Rules\Company\ExistModifierRevenueValidation;
use Illuminate\Foundation\Http\FormRequest;

final class AddServicesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = ServiceRequestCast::class;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'services' => ['nullable', 'array', new DuplicityServiceValidation(), new ExistModifierRevenueValidation()],
            'services.*.id' => ['nullable', 'integer'],
            'services.*.billing_company_id' => ['nullable', 'integer'],
            'services.*.procedure_id' => ['nullable', 'integer', 'required_without:services.*.revenue_code_id'],
            'services.*.revenue_code_id' => ['nullable', 'integer', 'required_without:services.*.procedure_id'],
            'services.*.modifier_id' => ['nullable', 'integer'],
            'services.*.price' => ['nullable', 'numeric', 'money', 'regex:/^\d*(\.\d{1,2})?$/'],
            'services.*.mac' => ['nullable', 'string'],
            'services.*.locality_number' => ['nullable', 'numeric'],
            'services.*.state' => ['nullable', 'string'],
            'services.*.fsa' => ['nullable', 'string'],
            'services.*.counties' => ['nullable', 'string'],
            'services.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'services.*.price_percentage' => ['nullable', 'numeric'],
            'services.*.clia' => ['nullable', 'string'],
            'services.*.medication_application' => ['nullable', 'boolean'],
            'services.*.medication' => ['nullable', 'array'],
            'services.*.medication.id' => ['nullable', 'integer'],
            'services.*.medication.drug_code' => [
                'nullable',
                'string',
                'regex:/^\d{11}$/',
                'required_if:services.*.medication_application,true',
            ],
            'services.*.medication.measurement_unit_id' => [
                'nullable',
                'integer',
                'required_if:services.*.medication_application,true',
            ],
            'services.*.medication.units' => [
                'nullable',
                'regex:/^\d{1,8}(\.\d{1,3})?$/',
                'required_if:services.*.medication_application,true',
            ],
            'services.*.medication.units_limit' => ['nullable', 'integer', 'gt:services.*.medication.units'],
            'services.*.medication.link_sequence_number' => ['nullable', 'regex:/^\d{1,50}$/'],
            'services.*.medication.pharmacy_prescription_number' => ['nullable', 'regex:/^\d{1,50}$/'],
            'services.*.medication.repackaged_NDC' => ['nullable', 'boolean'],
            'services.*.medication.code_NDC' => [
                'nullable',
                'string',
                'max:11',
                'required_if:services.*.medication.repackaged_NDC,true',
            ],
            'services.*.medication.claim_note_required' => ['nullable', 'boolean'],
            'services.*.medication.note' => ['nullable', 'string'],
        ];
    }
}
