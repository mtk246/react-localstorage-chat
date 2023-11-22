<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Http\Casts\Claim\UpdateRulesWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\Claim\RuleFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class UpdateRulesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = UpdateRulesWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'insurance_plan_id' => 'required|integer|exists:insurance_plans,id',
            'name' => 'required|string',
            'format' => [
                'required',
                new Enum(RuleFormatType::class),
            ],
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'required|integer|exists:type_catalogs,id',
            'rules.file' => 'required|array',
            'rules.file.*' => [
                'required',
                new RuleFormatRule($this->get('format', '')),
            ],
            'rules.digital.*' => [
                'required',
                'array',
                new RuleFormatRule($this->get('format', '')),
            ],
            'parameters' => 'nullable|array',
        ];
    }
}
