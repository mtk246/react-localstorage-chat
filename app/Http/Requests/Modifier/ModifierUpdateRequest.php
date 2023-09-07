<?php

declare(strict_types=1);

namespace App\Http\Requests\Modifier;

use App\Enums\Modifier\ClassificationType;
use App\Enums\Modifier\ModifierType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ModifierUpdateRequest extends FormRequest
{
    /** @return array<key, string|array<object|string>> */
    public function rules()
    {
        return [
            'description' => ['required', 'string'],
            'type' => ['required', new Enum(ModifierType::class)],
            'classification' => ['required', new Enum(ClassificationType::class)],
            'start_date' => ['required', 'date', 'exclude_if:end_date,false|before:end_date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after:start_date'],
            'modifier_invalid_combinations' => ['nullable', 'array'],
            'modifier_invalid_combinations.*' => ['nullable', 'string', 'max:2'],
            'special_coding_instructions' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }
}
