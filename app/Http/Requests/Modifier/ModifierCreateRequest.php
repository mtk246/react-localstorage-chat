<?php

namespace App\Http\Requests\Modifier;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IUnique;
use App\Models\Modifier;

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
            'modifier'                                            => ['required', 'string', 'max:2', new IUnique(Modifier::class, 'modifier')],
            'start_date'                                          => ['required', 'date'],
            'special_coding_instructions'                         => ['required', 'string'],
            'modifier_invalid_combinations'                       => ['required', 'array'],
            'modifier_invalid_combinations.*'                     => ['required', 'string', 'max:2'],
            'note'                                                => ['required', 'string']
        ];
    }
}
