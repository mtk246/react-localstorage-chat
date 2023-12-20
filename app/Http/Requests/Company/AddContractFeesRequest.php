<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ContractFeesRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\Modifier;
use App\Models\Procedure;
use App\Rules\Company\CustomValidateExist;
use App\Rules\Company\DuplicityContractValidation;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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
            'contract_fees' => ['nullable', 'array', new DuplicityContractValidation()],
            'contract_fees.*.billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'contract_fees.*.id' => [
                'nullable',
                'integer',
                new CustomValidateExist(),
            ],
            'contract_fees.*.insurance_company_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(InsuranceCompany::class),
            ],
            'contract_fees.*.insurance_plan_ids' => [
                'required',
                new IntegerOrArrayKeyExists(InsurancePlan::class),
            ],
            'contract_fees.*.procedure_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            'contract_fees.*.modifier_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(Modifier::class),
            ],
            'contract_fees.*.price' => ['nullable', 'numeric'],
            'contract_fees.*.type_id' => ['required', 'integer'],
            'contract_fees.*.start_date' => [
                'nullable',
                'date',
            ],
            'contract_fees.*.end_date' => [
                'nullable',
                'date',
            ],
            'contract_fees.*.mac' => ['nullable', 'string'],
            'contract_fees.*.locality_number' => ['nullable', 'numeric'],
            'contract_fees.*.state' => ['nullable', 'string'],
            'contract_fees.*.fsa' => ['nullable', 'string'],
            'contract_fees.*.counties' => ['nullable', 'string'],
            'contract_fees.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'contract_fees.*.price_percentage' => ['nullable', 'numeric'],
            'contract_fees.*.private_note' => ['nullable', 'string'],

            'contract_fees.*.patients' => ['required_if:*.type_id,18', 'array'],
            'contract_fees.*.patients.*.patient_id' => ['required', 'integer'],
            'contract_fees.*.patients.*.start_date' => [
                'required',
                'date',
                'before:contract_fees.*.patients.*.end_date',
            ],
            'contract_fees.*.patients.*.end_date' => [
                'nullable',
                'date',
                'after:contract_fees.*.patients.*.start_date',
            ],

            'contract_fees.*.have_contract_specifications' => ['nullable', 'boolean'],
            'contract_fees.*.contract_specifications' => ['nullable', 'array'],
            'contract_fees.*.contract_specifications.*.billing_provider_id' => ['nullable', 'string'],
            'contract_fees.*.contract_specifications.*.billing_provider_tax_id' => ['nullable', 'string'],
            'contract_fees.*.contract_specifications.*.billing_provider_taxonomy_id' => ['nullable', 'integer'],
            'contract_fees.*.contract_specifications.*.health_professional_id' => ['nullable', 'string'],
            'contract_fees.*.contract_specifications.*.health_professional_tax_id' => ['nullable', 'string'],
            'contract_fees.*.contract_specifications.*.health_professional_taxonomy_id' => ['nullable', 'integer'],
        ];
    }
}
