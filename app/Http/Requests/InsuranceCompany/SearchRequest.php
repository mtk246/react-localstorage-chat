<?php

declare(strict_types=1);

namespace App\Http\Requests\InsuranceCompany;

use Illuminate\Foundation\Http\FormRequest;

final class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'exclude' => 'nullable|array',
            'exclude.*' => 'required|numeric',
        ];
    }
}
