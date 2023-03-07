<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Requests\Casts\ContractFeesRequestCast;
use App\Models\Procedure;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

final class AddContractFeesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'contract_fees' => 'nullable|array',
            'contract_fees.*.billing_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'contract_fees.*.insurance_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsuranceCompany,id',
            ],
            'contract_fees.*.insurance_plan_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsurancePlan,id',
            ],
            'contract_fees.*.procedure_id' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            'contract_fees.*.modifier_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\Modifier,id',
            ],
            'contract_fees.*.price' => ['nullable', 'numeric'],
            'contract_fees.*.type_id' => ['nullable', 'integer'],
            'contract_fees.*.start_date' => ['nullable', 'date'],
            'contract_fees.*.end_date' => ['nullable', 'date'],
            'contract_fees.*.mac' => ['nullable', 'string'],
            'contract_fees.*.locality_number' => ['nullable', 'numeric'],
            'contract_fees.*.state' => ['nullable', 'string'],
            'contract_fees.*.fsa' => ['nullable', 'string'],
            'contract_fees.*.counties' => ['nullable', 'string'],
            'contract_fees.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'contract_fees.*.price_percentage' => ['nullable', 'numeric'],
            'contract_fees.*.private_note' => ['nullable', 'string'],
            'contract_fees.*.patien.*' => ['required_if:*.type_id,18', 'array'],
            'contract_fees.*.patien.*.user_id' => ['required', 'integer'],
            'contract_fees.*.patien.*.start_date' => ['nullable', 'date'],
            'contract_fees.*.patien.*.end_date' => ['nullable', 'date'],
        ];
    }

    public function castedCollect(): Collection
    {
        return collect($this->input('contract_fees'))
            ->map(fn (array $item) => new ContractFeesRequestCast($item, $this->user()));
    }
}
