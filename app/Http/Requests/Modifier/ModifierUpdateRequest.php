<?php

declare(strict_types=1);

namespace App\Http\Requests\Modifier;

use Illuminate\Foundation\Http\FormRequest;

class ModifierUpdateRequest extends FormRequest
{
    /** @return array<key, string|array<object|string>> */
    public function rules()
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'special_coding_instructions' => ['required', 'string'],
            'modifier_invalid_combinations' => ['nullable', 'array'],
            'modifier_invalid_combinations.*' => ['nullable', 'string', 'max:2'],
            'note' => ['required', 'string'],
        ];
    }
}
