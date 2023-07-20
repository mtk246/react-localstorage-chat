<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ServiceRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
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
            'services.*.medications' => ['nullable', 'array'],
            'services.*.medications.*.id' => ['nullable', 'integer'],
            'services.*.medications.*.drug_code' => ['required', 'string', 'max:10'],
            'services.*.medications.*.measurement_unit_id' => ['required', 'integer'],
            'services.*.medications.*.units' => ['required', 'numeric'],
            'services.*.medications.*.units_limit' => ['nullable', 'numeric'],
            'services.*.medications.*.link_sequence_number' => ['nullable', 'numeric'],
            'services.*.medications.*.pharmacy_prescription_number' => ['nullable', 'numeric'],
            'services.*.medications.*.repackaged_NDC' => ['nullable', 'boolean'],
            'services.*.medications.*.code_NDC' => ['required', 'string', 'max:10'],
            'services.*.medications.*.claim_note_required' => ['nullable', 'boolean'],
            'services.*.medications.*.note' => ['nullable', 'string'],
        ];
    }
}
