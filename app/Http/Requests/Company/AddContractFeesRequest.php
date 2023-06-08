<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ContractFeesRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Models\Modifier;
use App\Models\Procedure;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;

final class AddContractFeesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = ContractFeesRequestCast::class;

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
            'contract_fees.*.contract_fee_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\ContractFee,id',
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
                new IntegerOrArrayKeyExists(Modifier::class),
            ],
            'contract_fees.*.price' => ['nullable', 'numeric'],
            'contract_fees.*.type_id' => ['nullable', 'integer'],
            'contract_fees.*.start_date' => [
                'nullable',
                'date',
                'before:contract_fees.*.end_date',
            ],
            'contract_fees.*.end_date' => [
                'nullable',
                'date',
                'after:contract_fees.*.start_date',
            ],
            'contract_fees.*.mac' => ['nullable', 'string'],
            'contract_fees.*.locality_number' => ['nullable', 'numeric'],
            'contract_fees.*.state' => ['nullable', 'string'],
            'contract_fees.*.fsa' => ['nullable', 'string'],
            'contract_fees.*.counties' => ['nullable', 'string'],
            'contract_fees.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'contract_fees.*.price_percentage' => ['nullable', 'numeric'],
            'contract_fees.*.private_note' => ['nullable', 'string'],
            'contract_fees.*.patiens' => ['required_if:*.type_id,18', 'array'],
            'contract_fees.*.patiens.*.user_id' => ['required', 'integer'],
            'contract_fees.*.patiens.*.start_date' => [
                'required',
                'date',
                'before:contract_fees.*.patiens.*.end_date',
            ],
            'contract_fees.*.patiens.*.end_date' => [
                'nullable',
                'date',
                'after:contract_fees.*.patien.*.start_date',
            ],
        ];
    }
}
