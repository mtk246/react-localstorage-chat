<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\ClaimType;
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
            'name' => 'required|string',
            'format' => [
                'required',
                new Enum(ClaimType::class),
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
            'parameters' => 'nullable|array',
        ];
    }
}
