<?php

declare(strict_types=1);

namespace App\Http\Requests\Procedure;

use Illuminate\Foundation\Http\FormRequest;

class ProcedureConsiderationsUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'gender_id' => ['required', 'integer'],
            'age_init' => ['required', 'numeric'],
            'age_end' => ['nullable', 'numeric'],
            'age_type' => ['nullable', 'numeric'],
            'discriminatory_id' => ['required', 'numeric'],
            'frequent_diagnoses' => ['nullable', 'array'],
            'frequent_modifiers' => ['nullable', 'array'],
            'claim_note' => ['nullable', 'boolean'],
            'supervisor' => ['nullable', 'boolean'],
            'authorization' => ['nullable', 'boolean'],
        ];
    }
}
