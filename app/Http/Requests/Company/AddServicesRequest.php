<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ServiceRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'services' => ['required', 'array'],
            'services.*.id' => ['nullable', 'integer'],
            'services.*.billing_company_id' => ['nullable', 'integer'],
            'services.*.procedure_ids' => ['required', 'array'],
            'services.*.modifier_ids' => ['nullable', 'array'],
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
                Rule::requiredIf(fn () => true === $this->input('medication_application', false)),
                'nullable',
                'string',
                'max:11',
            ],
            'services.*.medication.measurement_unit_id' => [
                Rule::requiredIf(fn () => true === $this->input('medication_application', false)),
                'nullable',
                'integer',
            ],
            'services.*.medication.units' => [
                Rule::requiredIf(fn () => true === $this->input('medication_application', false)),
                'nullable',
                'numeric',
            ],
            'services.*.medication.units_limit' => ['nullable', 'numeric'],
            'services.*.medication.link_sequence_number' => ['nullable', 'numeric'],
            'services.*.medication.pharmacy_prescription_number' => ['nullable', 'numeric'],
            'services.*.medication.repackaged_NDC' => ['nullable', 'boolean'],
            'services.*.medication.code_NDC' => [
                Rule::requiredIf(
                    fn () => (
                        true === $this->input('medication_application', false) &&
                        true === $this->input('repackaged_NDC', false)
                    )
                ),
                'nullable',
                'string',
                'max:11',
            ],
            'services.*.medication.claim_note_required' => ['nullable', 'boolean'],
            'services.*.medication.note' => ['nullable', 'string'],
        ];
    }
}
