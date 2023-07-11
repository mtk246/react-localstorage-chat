<?php

declare(strict_types=1);

namespace App\Http\Requests\Diagnosis;

use App\Enums\Diagnoses\DiagnosesType;
use App\Models\Diagnosis;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DiagnosisCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'string', 'max:50', new IUnique(Diagnosis::class, 'code')],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'description' => ['required', 'string', 'max:255'],
            'injury_date_required' => ['nullable', 'boolean'],
            'note' => ['nullable', 'string'],
            'description_long' => ['nullable', 'string'],
            'gender_id' => ['nullable', 'integer'],
            'age' => [
                'required_if:injury_date_required,true',
                'string',
            ],
            'age_end' => ['nullable', 'string'],
            'discriminatory_id' => ['nullable', 'numeric'],

            'type' => ['required', new Enum(DiagnosesType::class)],
            'clasifications' => ['nullable', 'array'],
            'clasifications.general' => ['nullable', 'integer'],
            'clasifications.specific' => ['nullable', 'integer'],
        ];
    }
}
