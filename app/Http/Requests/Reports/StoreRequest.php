<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Enums\Reports\ReportType;
use App\Enums\Reports\TagType;
use App\Http\Casts\Reports\StoreRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class StoreRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreRequestCast::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'name' => 'required|string',
            'use' => 'required|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => ['required', 'integer', new Enum(TagType::class)],
            'type' => ['required', 'integer', new Enum(ReportType::class)],
            'range' => ['required', 'string'],
            'configuration' => 'required|array',
            'configuration.columns' => ['nullable', 'array'],
            'configuration.columns.*' => ['nullable', 'string'],
        ];
    }
}