<?php

declare(strict_types=1);

namespace App\Http\Requests\Procedure;

use Illuminate\Foundation\Http\FormRequest;

final class ProcedureNoteUpdateRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'note' => ['nullable', 'string'],
        ];
    }
}
