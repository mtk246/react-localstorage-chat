<?php

namespace App\Http\Requests\Modifier;

use Illuminate\Foundation\Http\FormRequest;

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
            'modifier',
            'invalid_combination',
            'special_coding_instructions',
            'active',
            'deactivated_date'
        ];
    }
}
