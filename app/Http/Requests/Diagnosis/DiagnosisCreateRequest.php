<?php

declare(strict_types=1);

namespace App\Http\Requests\Diagnosis;

use App\Models\Diagnosis;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;

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
            'description' => ['required', 'string', 'max:255'],
            'injury_date_required' => ['nullable', 'boolean'],
            'note' => ['required', 'string'],
        ];
    }
}
