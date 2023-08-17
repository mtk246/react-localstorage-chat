<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\ExceptionInsuranceWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Models\InsurancePlan;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreExceptionInsuranceRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = ExceptionInsuranceWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'store' => ['nullable', 'array'],
            'store.*.id' => ['nullable', 'integer'],
            'store.*.billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'store.*.insurance_plan_ids' => [
                'required',
                new IntegerOrArrayKeyExists(InsurancePlan::class),
            ],
        ];
    }
}
