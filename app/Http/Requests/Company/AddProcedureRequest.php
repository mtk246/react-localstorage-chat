<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class AddProcedureRequest extends FormRequest
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
     * @return array <string, mixed>
     */
    public function rules()
    {
        return [
            'mac_localities'                                                   => ['required', 'array'],
            'mac_localities.*.procedure_id'                                    => ['required', 'integer'],
            'mac_localities.*.mac'                                             => ['sometimes', 'string'],
            'mac_localities.*.modifier_id'                                     => ['sometimes', 'integer'],
            'mac_localities.*.locality_number'                                 => ['sometimes', 'numeric'],
            'mac_localities.*.state'                                           => ['sometimes', 'string'],
            'mac_localities.*.fsa'                                             => ['sometimes', 'string'],
            'mac_localities.*.counties'                                        => ['sometimes', 'string'],
            
            'mac_localities.*.procedure_fees'                                  => ['nullable', 'array'],
            'mac_localities.*.procedure_fees.non_facility_price'               => ['sometimes', 'numeric'],
            'mac_localities.*.procedure_fees.facility_price'                   => ['sometimes', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_limiting_charge'     => ['sometimes', 'numeric'],
            'mac_localities.*.procedure_fees.facility_limiting_charge'         => ['sometimes', 'numeric'],
            'mac_localities.*.procedure_fees.facility_rate'                    => ['sometimes', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_rate'                => ['sometimes', 'numeric'],

            'mac_localities.*.company_procedure'                               => ['nullable', 'array'],
            'mac_localities.*.company_procedure.price'                         => ['sometimes', 'numeric'],
            'mac_localities.*.company_procedure.price_percentage'              => ['sometimes', 'numeric'],
            'mac_localities.*.company_procedure.insurance_label_fee_id'        => ['sometimes', 'integer'],

            'mac_localities.*.insurance_plan_procedure'                        => ['nullable', 'array'],
            'mac_localities.*.insurance_plan_procedure.price'                  => ['sometimes', 'numeric'],
            'mac_localities.*.insurance_plan_procedure.price_percentage'       => ['sometimes', 'numeric'],
            'mac_localities.*.insurance_plan_procedure.insurance_label_fee_id' => ['sometimes', 'integer'],
            'mac_localities.*.insurance_plan_procedure.insurance_plan_id'      => ['required', 'integer'],
        ];
    }
}
