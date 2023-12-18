<?php

declare(strict_types=1);

namespace App\Http\Requests\InsurancePlan;

use App\Http\Casts\InsurancePlan\CopayRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Models\Company;
use App\Models\Procedure;
use App\Rules\Company\DuplicityCopayValidation;
use App\Rules\IntegerOrArrayKeyExists;
use Illuminate\Foundation\Http\FormRequest;

final class AddCopaysRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = CopayRequestCast::class;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'copays' => ['nullable', 'array', new DuplicityCopayValidation()],
            'copays.*.id' => [
                'nullable',
                'integer',
                'exists:\App\Models\Copay,id',
            ],
            'copays.*.billing_company_id' => [
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'copays.*.procedure_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(Procedure::class),
            ],
            'copays.*.companies_ids' => [
                'nullable',
                new IntegerOrArrayKeyExists(Company::class),
            ],
            'copays.*.copay' => [
                'nullable',
                'numeric',
                'between:0,999999.99',
            ],
            'copays.*.private_note' => ['nullable', 'string'],
        ];
    }
}
