<?php

declare(strict_types=1);

namespace App\Http\Requests\HealthProfessional;

use App\Http\Casts\HealthProfessional\StoreCompanyRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreCompanyRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreCompanyRequestCast::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'companies' => 'required|array',
            'companies.*.id' => 'nullable|integer',
            'companies.*.billing_company_id' => [
                Rule::requiredIf(fn () => Gate::allows('is-admin')),
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'companies.*.company_id' => [
                'required',
                'integer',
                'exists:\App\Models\Company,id',
            ],
            'companies.*.authorization' => 'nullable|array',
            'companies.*.authorization.*' => 'required|integer',
        ];
    }
}
