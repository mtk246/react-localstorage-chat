<?php

declare(strict_types=1);

namespace App\Http\Requests\ClaimSubStatus;

use App\Models\ClaimSubStatus;
use App\Rules\IUnique;
use Illuminate\Foundation\Http\FormRequest;

class ClaimSubStatusUpdateRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:20', new IUnique(ClaimSubStatus::class, 'code', $this->id)],
            'name' => ['required', 'string', 'max:50', new IUnique(ClaimSubStatus::class, 'name', $this->id)],
            'description' => ['nullable', 'string'],
            'claim_statuses' => ['required', 'array'],
            'billing_companies' => ['nullable', 'array'],
            'specific_billing_company' => ['nullable', 'boolean'],
        ];
    }
}
