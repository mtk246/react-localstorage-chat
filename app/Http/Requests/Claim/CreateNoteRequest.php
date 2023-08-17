<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Http\Casts\Claims\NoteRequestWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class CreateNoteRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = NoteRequestWrapper::class;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'private_note' => ['required', 'string'],
        ];
    }
}
