<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Http\Casts\Claim\UpdateRulesWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\Claim\RuleFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class UpdateRulesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = UpdateRulesWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'company_ids' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'company_ids.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'integer',
                'exists:companies,id',
            ],
            'insurance_company_ids' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'insurance_company_ids.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'integer',
                'exists:insurance_companies,id',
            ],
            'insurance_plan_ids' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'insurance_plan_ids.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'integer',
                'exists:insurance_plans,id',
            ],
            'name' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'string',
            ],
            'format' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                new Enum(RuleFormatType::class),
            ],
            'responsibilities' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'responsibilities.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'integer',
                'exists:type_catalogs,id',
            ],
            'rules.file' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'rules.file.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                new RuleFormatRule($this->get('format', '')),
            ],
            'rules.json' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'rules.json.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                new RuleFormatRule($this->get('format', '')),
            ],
            'rules.digital.*' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'required',
                'array',
                new RuleFormatRule($this->get('format', '')),
            ],
            'parameters' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'array',
            ],
            'active' => [
                'nullable',
                'boolean',
            ],
            'note' => [
                Rule::excludeIf(fn () => filled($this->input('active', ''))),
                'nullable',
                'string',
            ],
        ];
    }
}
