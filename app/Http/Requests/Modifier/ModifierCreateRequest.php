<?php

declare(strict_types=1);

namespace App\Http\Requests\Modifier;

use App\Models\Modifier;
use App\Rules\IUnique;
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
            'modifier' => ['required', 'string', 'max:2', new IUnique(Modifier::class, 'modifier')],
            'start_date' => ['required', 'date'],
            'special_coding_instructions' => ['required', 'string'],
            'modifier_invalid_combinations' => ['nullable', 'array'],
            'modifier_invalid_combinations.*' => ['nullable', 'string', 'max:2'],
            'note' => ['required', 'string'],
        ];
    }
}
