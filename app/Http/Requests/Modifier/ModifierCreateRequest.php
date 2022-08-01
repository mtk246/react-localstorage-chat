<?php

namespace App\Http\Requests\Modifier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierCreateRequest extends FormRequest
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
            'modifier'                                            => ['required', 'string', 'max:2', Rule::unique('modifiers', 'modifier')],
            'start_date'                                          => ['required', 'date'],
            'special_coding_instructions'                         => ['required', 'string'],
            'modifier_invalid_combinations'                       => ['required', 'array'],
            'modifier_invalid_combinations.*.invalid_combination' => ['required', 'string', 'max:2'],
            'note'                                                => ['required', 'string']
        ];
    }
}
