<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use Illuminate\Foundation\Http\FormRequest;

final class ClaimCheckStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            "response_details" => ['nullable', 'string'],
            "interface_type" => ['nullable', 'string'],
            "interface" => ['nullable', 'string'],
            "consultation_date" => ['nullable', 'date'],
            "resolution_time" => ['nullable', 'date'],
            "past_due_date" => ['nullable', 'date'],
            "private_note" => ['required', 'string'],
        ];
    }
}
