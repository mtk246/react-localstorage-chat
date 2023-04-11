<?php

namespace App\Http\Requests\InsurancePlan;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TypeCatalog;

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
        $type_id = TypeCatalog::query()
            ->where(['code' => 'CAP', 'description' => 'CAP'])
            ->whereHas('type', function ($query) {
                $query->where('description', 'Contract fee type');
            })->value('id');

        return [
            'contract_fees' => ['required', 'array'],
            'contract_fees.*.id' => ['nullable', 'integer'],
            'contract_fees.*.billing_company_id' => ['nullable', 'integer'],
            'contract_fees.*.company_id' => ['required', 'integer'],
            'contract_fees.*.type_id' => ['required', 'integer'],
            'contract_fees.*.start_date' => ['required', 'date'],
            'contract_fees.*.end_date' => ['required', 'date'],
            'contract_fees.*.procedure_ids' => ['required', 'array'],
            'contract_fees.*.modifier_id' => ['nullable', 'integer'],
            'contract_fees.*.mac' => ['nullable', 'string'],
            'contract_fees.*.locality_number' => ['nullable', 'numeric'],
            'contract_fees.*.state' => ['nullable', 'string'],
            'contract_fees.*.fsa' => ['nullable', 'string'],
            'contract_fees.*.counties' => ['nullable', 'string'],
            'contract_fees.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'contract_fees.*.price' => ['nullable', 'numeric', 'sometimes', 'required_without_all:contract_fees.*.price_percentage', 'prohibited_unless:contract_fees.*.price_percentage,null'],
            'contract_fees.*.price_percentage' => ['nullable', 'numeric', 'sometimes', 'required_without_all:contract_fees.*.price', 'prohibited_unless:contract_fees.*.price,null'],
            'contract_fees.*.private_note' => ['nullable', 'string'],
            'contract_fees.*.patients' => ['array', 'required_if:contract_fees.*.type_id,'.$type_id],
            'contract_fees.*.patients.*.patient_id' => ['sometimes', 'integer'],
            'contract_fees.*.patients.*.start_date' => ['nullable', 'date'],
            'contract_fees.*.patients.*.end_date' => ['nullable', 'date'],
        ];
    }
}
