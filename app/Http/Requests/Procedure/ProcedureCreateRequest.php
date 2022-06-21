<?php

namespace App\Http\Requests\Procedure;

use Illuminate\Foundation\Http\FormRequest;

class ProcedureCreateRequest extends FormRequest
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
            'code'                                                         => ['required', 'string', 'max:50'],
            'description'                                                  => ['required', 'string'],
            'insurance_company_id'                                         => ['required', 'integer'],
            
            'mac_localities'                                               => ['required', 'array'],
            'mac_localities.*.mac'                                         => ['required', 'string'],
            'mac_localities.*.modifier_id'                                 => ['required', 'string'],
            'mac_localities.*.locality_number'                             => ['required', 'integer'],
            'mac_localities.*.state'                                       => ['required', 'string'],
            'mac_localities.*.fsa'                                         => ['required', 'string'],
            'mac_localities.*.counties'                                    => ['required', 'string'],
            
            'mac_localities.*.procedure_fees'                              => ['required', 'array'],
            'mac_localities.*.procedure_fees.non_facility_price'           => ['sometimes', 'required', 'numeric'],
            'mac_localities.*.procedure_fees.facility_price'               => ['sometimes', 'required', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_limiting_charge' => ['sometimes', 'required', 'numeric'],
            'mac_localities.*.procedure_fees.facility_limiting_charge'     => ['sometimes', 'required', 'numeric'],

            'mac_localities.*.procedure_fees.facility_rate'                => ['sometimes', 'required', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_rate'            => ['sometimes', 'required', 'numeric'],

            'procedure_considerations'                                     => ['required', 'array'],
            'procedure_considerations.gender_id'                           => ['required', 'integer'],
            'procedure_considerations.age_init'                            => ['required', 'numeric'],
            'procedure_considerations.age_end'                             => ['sometimes', 'required', 'numeric'],
            'procedure_considerations.discriminatory_id'                   => ['required', 'numeric'],

            'modifiers'                                                    => ['required', 'array'],
            'diagnoses'                                                    => ['required', 'array'],
            'note'                                                         => ['required', 'string']
        ];
    }
}
