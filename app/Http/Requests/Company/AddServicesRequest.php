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
            'services.*.procedure_id' => [
                'required',
                'integer',
                'exists:\App\Models\Procedure,id',
            ],
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
            'services.*.medications' => ['nullable', 'array'],
            'services.*.medications.*.id' => 'nullable|integer',
            'services.*.medications.*.date' => 'required|date',
            'services.*.medications.*.drug_code' => 'required|string',
            'services.*.medications.*.batch' => 'required|string',
            'services.*.medications.*.quantity' => 'required|integer',
            'services.*.medications.*.frequency' => 'required|integer',
        ];
    }
}
