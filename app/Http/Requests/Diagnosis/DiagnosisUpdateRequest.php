<?php

declare(strict_types=1);

namespace App\Http\Requests\Diagnosis;

use Illuminate\Foundation\Http\FormRequest;

use App\Enums\Diagnoses\DiagnosesType;
use Illuminate\Validation\Rules\Enum;

class DiagnosisUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'description' => ['required', 'string', 'max:255'],
            'injury_date_required' => ['nullable', 'boolean'],
            'note' => ['required', 'string'],

            'type' => ['required', new Enum(DiagnosesType::class)],
            'clasifications' => ['required', 'array'],
            'clasifications.specific' => ['nullable', 'integer'],
            'clasifications.sub_specific' => ['nullable', 'integer'],
        ];
    }
}
