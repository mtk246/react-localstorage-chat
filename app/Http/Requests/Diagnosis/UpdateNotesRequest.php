<?php

declare(strict_types=1);

namespace App\Http\Requests\Diagnosis;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateNotesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'public_note' => ['nullable', 'string'],
        ];
    }
}
