<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\StatementCast;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\DistinctArray;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreStatementRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StatementCast::class;

    public function authorize(): bool
    {
        return true;
    }

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
            'store.*.rule_id' => ['nullable', 'integer'],
            'store.*.when_id' => ['nullable', 'integer'],
            'store.*.apply_to_ids' => [
                'nullable',
                'array',
                new DistinctArray(),
            ],
            'store.*.apply_to_ids.*' => [
                'nullable',
                'integer',
            ],
            'store.*.start_date' => [
                'nullable',
                'date',
                'required_with:store.*.end_date',
                function ($attribute, $value, $fail) {
                    $index = str_replace(['store.', '.start_date'], '', $attribute);

                    if (!empty($this->input("store.$index.end_date"))) {
                        $endDate = $this->input("store.$index.end_date");

                        if (strtotime($value) > strtotime($endDate)) {
                            $fail("$attribute debe ser anterior o igual a end_date.");
                        }
                    }
                },
            ],
            'store.*.end_date' => ['nullable', 'date'],
        ];
    }
}
