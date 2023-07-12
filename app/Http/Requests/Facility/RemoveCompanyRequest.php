<?php

declare(strict_types=1);

namespace App\Http\Requests\Facility;

use Illuminate\Foundation\Http\FormRequest;

final class RemoveCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'company_id' => ['required', 'integer'],
            'billing_company_id' => ['nullable', 'integer']
        ];
    }
}
