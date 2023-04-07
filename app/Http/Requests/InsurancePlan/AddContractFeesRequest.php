<?php

namespace App\Http\Requests\InsurancePlan;

use Illuminate\Foundation\Http\FormRequest;

class AddContractFeesRequest extends FormRequest
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
            'contract_fees' => ['required', 'array'],
            'contract_fees.*.id' => ['nullable', 'integer'],
            'contract_fees.*.billing_company_id' => ['nullable', 'integer'],
            'contract_fees.*.company_id' => ['nullable', 'integer'],
            'contract_fees.*.type_id' => ['nullable', 'integer'],
            'contract_fees.*.start_date' => ['required', 'date'],
            'contract_fees.*.end_date' => ['required', 'date'],
            'contract_fees.*.procedure_ids' => ['required', 'array'],
            'contract_fees.*.modifier_id' => ['nullable', 'integer'],
            'contract_fees.*.price' => ['required', 'numeric'],
            'contract_fees.*.mac' => ['nullable', 'string'],
            'contract_fees.*.locality_number' => ['nullable', 'numeric'],
            'contract_fees.*.state' => ['nullable', 'string'],
            'contract_fees.*.fsa' => ['nullable', 'string'],
            'contract_fees.*.counties' => ['nullable', 'string'],
            'contract_fees.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'contract_fees.*.price_percentage' => ['nullable', 'numeric'],
            'contract_fees.*.private_note' => ['nullable', 'string'],
        ];
    }
}
