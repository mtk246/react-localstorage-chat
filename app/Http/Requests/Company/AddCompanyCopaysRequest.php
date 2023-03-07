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
            'copays' => 'nullable|array',
            'copays.*.billing_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'copays.*.procedure_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            'copays.*.insurance_plan_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsurancePlan,id',
            ],
            'copays.*.insurance_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\InsuranceCompany,id',
            ],
            'copays.*.copay' => [
                'nullable',
                'numeric',
                'between:0,999999.99',
            ],
            'copays.*.private_note' => ['nullable', 'string'],
        ];
    }

    public function getCopays(): Collection
    {
        return collect($this->input('copays'))
            ->map(fn (array $item) => new CopayRequestCast($item, $this->user()));
    }
}
