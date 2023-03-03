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
            '*.billing_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            '*.insurance_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsuranceCompany,id',
            ],
            '*.insurance_plan_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsurancePlan,id',
            ],
            '*.procedure_id' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            '*.modifier_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\Modifier,id',
            ],
            '*.price' => ['nullable', 'numeric'],
            '*.type_id' => ['nullable', 'integer'],
            '*.start_date' => ['nullable', 'date'],
            '*.end_date' => ['nullable', 'date'],
            '*.mac' => ['nullable', 'string'],
            '*.locality_number' => ['nullable', 'numeric'],
            '*.state' => ['nullable', 'string'],
            '*.fsa' => ['nullable', 'string'],
            '*.counties' => ['nullable', 'string'],
            '*.insurance_label_fee_id' => ['nullable', 'integer'],
            '*.price_percentage' => ['nullable', 'numeric'],
            '*.private_note' => ['nullable', 'string'],
            '*.patien.*' => ['required_if:*.type_id,18', 'array'],
            '*.patien.*.user_id' => ['required', 'integer'],
            '*.patien.*.start_date' => ['nullable', 'date'],
            '*.patien.*.end_date' => ['nullable', 'date'],
        ];
    }

    public function castedCollect(): Collection
    {
        return collect($this->all())
            ->map(fn (array $item) => new ContractFeesRequestCast($item, $this->user()));
    }
}
