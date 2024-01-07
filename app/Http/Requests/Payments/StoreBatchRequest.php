<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use App\Enums\Payments\SourceType;
use App\Http\Casts\Payments\StoreBatchWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

/** @method StoreBatchWrapper casted() */
final class StoreBatchRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreBatchWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(fn () => Gate::allows('is-admin')),
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'company_id' => [
                'required',
                'integer',
                'exists:\App\Models\Company,id',
            ],
            'name' => 'required|string|unique:payment_batches,name',
            'posting_date' => 'nullable|date',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'payments' => 'required|array',
            'payments.*.order' => 'nullable|integer|distinct',
            'payments.*.source_id' => ['required', 'integer', new Enum(SourceType::class)],
            'payments.*.insurance_plan_id' => [
                'required_if:payments.*.source_id,2',
                'required_if:payments.*.source_id,4',
                'nullable',
                'integer',
                'exists:\App\Models\InsurancePlan,id',
            ],
            'payments.*.payment_date' => 'required|date',
            'payments.*.currency' => 'required|string',
            'payments.*.amount' => 'required|numeric',
            'payments.*.method' => 'required|string',
            'payments.*.reference' => 'nullable|integer',
            'payments.*.card_num' => [
                'prohibited_if:payments.*.method,3',
                'nullable',
                'integer',
            ],
            'payments.*.card_date' => [
                'prohibited_if:payments.*.method,3',
                'nullable',
                'integer',
            ],
            'payments.*.statement' => 'required|boolean',
            'payments.*.note' => 'nullable|string',
            'payments.*.eobs' => 'nullable|array',
            'payments.*.eobs.*.name' => 'required|string',
            'payments.*.eobs.*.date' => 'required|date',
            'payments.*.eobs.*.file_name' => 'required|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:pdf,jpg,jpeg,png',
        ];
    }
}
