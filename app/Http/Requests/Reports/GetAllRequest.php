<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Enums\Reports\ClassificationType;
use App\Http\Casts\Reports\GetAllCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
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
                'nullable',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'clasifications' => 'nullable|array',
            'clasifications.*' => ['required', 'integer', new Enum(ClassificationType::class)],
            'favorite' => 'nullable|boolean',
        ];
    }
}
