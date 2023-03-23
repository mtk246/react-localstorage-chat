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
            'npi' => 'required|integer',
            'ein' => 'nullable|string|max:9',
            'upin' => 'nullable|string|max:50',
            'clia' => 'nullable|string|max:50',
            'nickname' => 'nullable|string',
            'abbreviation' => 'nullable|string|max:20',
            'taxonomies' => 'nullable|array',
            'taxonomies.*.tax_id' => 'sometimes|string',
            'taxonomies.*.name' => 'sometimes|string',
            'taxonomies.*.primary' => 'sometimes|boolean',
        ];
    }
}
