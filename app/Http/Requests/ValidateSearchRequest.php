<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSearchRequest extends FormRequest
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
            'date_of_birth' => ['nullable'],
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'ssn' => ['nullable', 'string'],
        ];
    }
}
