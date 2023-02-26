<?php

namespace App\Http\Requests\InsurancePlan;

use Illuminate\Foundation\Http\FormRequest;

class AddCopaysRequest extends FormRequest
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
            'copays'                      => ['required', 'array'],
            'copays.*.billing_company_id' => ['nullable', 'integer'],
            'copays.*.procedure_ids'      => ['required', 'array'],
            'copays.*.company_id'         => ['nullable', 'integer'],
            'copays.*.copay'              => ['nullable', 'numeric'],
            'copays.*.private_note'       => ['nullable', 'string'],
        ];
    }
}
