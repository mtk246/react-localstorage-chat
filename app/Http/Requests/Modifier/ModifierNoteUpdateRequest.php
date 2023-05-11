<?php

declare(strict_types=1);

namespace App\Http\Requests\Modifier;

use Illuminate\Foundation\Http\FormRequest;

final class ModifierNoteUpdateRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'note' => ['nullable', 'string'],
        ];
    }
}
