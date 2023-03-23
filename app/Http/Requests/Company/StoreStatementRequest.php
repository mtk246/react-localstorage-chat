<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\StoreStatementRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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
            'store.*.apply_to_ids' => 'nullable|array',
            'store.*.start_date' => 'nullable|date',
            'store.*.end_date' => 'nullable|date',
            'delete' => 'nullable|array',
            'delete.*' => 'accepted|integer',
        ];
    }
}
