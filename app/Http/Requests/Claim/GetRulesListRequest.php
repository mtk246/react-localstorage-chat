<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Enums\Claim\ClaimType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class GetRulesListRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'type' => ['nullable', 'integer', Rule::enum(ClaimType::class)],
        ];
    }
}
