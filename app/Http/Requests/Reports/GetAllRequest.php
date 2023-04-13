<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Enums\Reports\TagType;
use App\Http\Casts\Reports\GetAllCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class GetAllRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = GetAllCast::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'tags' => 'nullable|array',
            'tags.*' => ['required', 'integer', new Enum(TagType::class)],
            'favorite' => 'nullable|boolean',
        ];
    }
}
