<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Requests\Casts\CopayRequestCast;
use App\Models\Procedure;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

final class AddCompanyCopaysRequest extends FormRequest
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
            '*.procedure_id' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            '*.insurance_plan_id' => [
                'required',
                'integer',
                'exists:\App\Models\InsurancePlan,id',
            ],
            '*.insurance_company_id' => [
                'required',
                'integer',
                'exists:\App\Models\InsuranceCompany,id',
            ],
            '*.copay' => [
                'required',
                'numeric',
                'between:0,999999.99',
            ],
            '*.private_note' => ['nullable', 'string'],
        ];
    }

    public function getCopays(): Collection
    {
        return collect($this->all())
            ->map(fn (array $item) => new CopayRequestCast($item, $this->user()));
    }
}
