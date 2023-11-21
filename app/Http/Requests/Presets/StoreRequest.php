<?php

declare(strict_types=1);

namespace App\Http\Requests\Presets;

use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'base_report_id' => 'nullable|exists:\App\Models\Reports\Report,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'filter' => ['required', 'array'],
        ];
    }
}
