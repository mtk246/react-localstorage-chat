<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Enums\Reports\ClassificationType;
use App\Enums\Reports\ReportType;
use App\Http\Casts\Reports\UpdateRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class UpdateRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = UpdateRequestCast::class;

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
            'description' => 'nullable|string',
            'clasification' => ['required', 'integer', new Enum(ClassificationType::class)],
            'type' => ['required', 'integer', new Enum(ReportType::class)],
            'range' => ['required', 'string'],
            'configuration' => 'required|array',
            'configuration.columns' => ['nullable', 'array'],
            'configuration.columns.*' => ['nullable', 'string'],
            'favorite' => 'nullable|boolean',
        ];
    }
}
