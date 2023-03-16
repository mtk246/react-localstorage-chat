<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Rules\KeyboardShortcut;
use Illuminate\Foundation\Http\FormRequest;

final class StoreKeyboardShortcutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'update' => 'nullable|array',
            'update.*.id' => 'required|integer|exists:\App\Models\KeyboardShortcut,id',
            'update.*.key' => [
                'required',
                'string',
                'max:20',
                new KeyboardShortcut(),
            ],
            'delete' => 'nullable|array',
            'delete.*.id' => 'required|integer|exists:\App\Models\KeyboardShortcut,id',
        ];
    }
}
