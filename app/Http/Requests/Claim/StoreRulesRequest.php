<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Http\Casts\Claim\StoreRulesWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\Claim\RuleFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class StoreRulesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreRulesWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'insurance_company_ids' => 'nullable|array',
            'insurance_company_ids.*' => 'required|integer|exists:insurance_companies,id',
            'insurance_plan_ids' => 'nullable|array',
            'insurance_plan_ids.*' => 'required|integer|exists:insurance_plans,id',
            'name' => 'required|string',
            'format' => [
                'required',
                new Enum(RuleFormatType::class),
            ],
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'required|integer|exists:type_catalogs,id',
            'rules.file' => 'nullable|array',
            'rules.file.*' => [
                'nullable',
                new RuleFormatRule($this->get('format', '')),
            ],
            'rules.json.*' => [
                'nullable',
                'array',
                new RuleFormatRule($this->get('format', '')),
            ],
            'parameters' => 'nullable|array',
            'note' => 'nullable|string',
        ];
    }
}
