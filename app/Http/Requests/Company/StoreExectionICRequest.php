<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\StoreExectionICRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreExectionICRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreExectionICRequestCast::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'nullable',
            ],
            'store' => 'nullable|array',
            'store.*.id' => 'nullable|integer',
            'store.*.insurance_company_id' => [
                'required',
                'integer',
                'exists:\App\Models\InsuranceCompany,id',
            ],
            'delete' => 'nullable|array',
            'delete.*' => 'nullable|integer',
        ];
    }
}
