<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\CompanyPatientWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class UpdatePatientRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = CompanyPatientWrapper::class;

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
            'store.*.patient_id' => ['nullable', 'integer'],
            'store.*.med_num' => ['nullable', 'string'],
        ];
    }
}
