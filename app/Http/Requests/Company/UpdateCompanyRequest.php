<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\UpdateCompanyRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class UpdateCompanyRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = UpdateCompanyRequestCast::class;

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
            'npi' => ['required', 'integer'],
            'ein' => ['required', 'string', 'regex:/^\d{2}-\d{7}$/'],
            'clia' => ['nullable', 'string', 'max:50'],
            'nickname' => ['nullable', 'string'],
            'abbreviation' => ['nullable', 'string', 'max:20'],
            'other_name' => ['nullable', 'string', 'max:255'],
            'miscellaneous' => ['nullable', 'string', 'max:255'],
            'claim_format_ids' => ['required', 'array'],

            'taxonomies' => ['nullable', 'array'],
            'taxonomies.*.tax_id' => ['sometimes', 'string', 'distinct'],
            'taxonomies.*.name' => ['sometimes', 'string'],
            'taxonomies.*.primary' => ['sometimes', 'boolean'],
        ];
    }
}
