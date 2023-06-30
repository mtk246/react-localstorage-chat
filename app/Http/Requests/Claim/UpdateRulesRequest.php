<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Rules\Claim\RuleFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class UpdateRulesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'format' => [
                'required',
                new Enum(RuleFormatType::class),
            ],
            'rules.file.*' => [
                'required',
                'array',
                new RuleFormatRule($this->format),
            ],
            'rules.digital.*' => [
                'required',
                'array',
                new RuleFormatRule($this->format),
            ],
        ];
    }
}
