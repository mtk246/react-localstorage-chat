<?php

namespace App\Http\Requests\Procedure;

use Illuminate\Foundation\Http\FormRequest;

class ProcedureUpdateRequest extends FormRequest
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
            'description'                                                  => ['required', 'string'],
            'companies'                                                    => ['nullable', 'array'],
            'specific_company'                                             => ['required', 'boolean', 'nullable'],
            'start_date'                                                   => ['required', 'date'],
            'end_date'                                                     => ['nullable', 'date'],
            
            'mac_localities'                                               => ['required', 'array'],
            'mac_localities.*.mac'                                         => ['required', 'string'],
            'mac_localities.*.modifier_id'                                 => ['required', 'integer'],
            'mac_localities.*.locality_number'                             => ['required', 'numeric'],
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
            'procedure_considerations.age_end'                             => ['nullable', 'numeric'],
            'procedure_considerations.discriminatory_id'                   => ['required', 'numeric'],

            'modifiers'                                                    => ['required', 'array'],
            'diagnoses'                                                    => ['required', 'array'],
            'note'                                                         => ['required', 'string']
        ];
    }
}
