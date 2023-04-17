<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Enums\Company\ApplyToType;
use App\Http\Casts\Company\StoreStatementRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\DistinctArray;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class StoreStatementRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreStatementRequestCast::class;

    public function authorize(): bool
    {
        return true;
    }

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
            'store.*.rule_id' => 'nullable|integer',
            'store.*.when_id' => 'nullable|integer',
            'store.*.apply_to_ids' => [
                'nullable',
                'array',
                new DistinctArray(),
            ],
            'store.*.apply_to_ids.*' => [
                'nullable',
                'integer',
                new Enum(ApplyToType::class),
            ],
            'store.*.start_date' => 'nullable|date|before:store.*.end_date',
            'store.*.end_date' => 'nullable|date',
        ];
    }
}
