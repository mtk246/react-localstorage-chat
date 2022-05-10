<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name'                                 => ['required', 'string', 'max:50'],
            'description'                          => ['required', 'string', 'nullable'],
            'aplicable_to'                         => ['required', 'string', 'max:50'],
            'rev_code'                             => ['required', 'string', 'max:50', 'nullable'],
            'use_time_units'                       => ['required', 'string', 'max:50', 'nullable'],
            'ndc_number'                           => ['required', 'string', 'max:50', 'nullable'],
            'units'                                => ['required', 'string', 'max:50', 'nullable'],
            'measure'                              => ['required', 'string', 'max:50', 'nullable'],
            'units_limit'                          => ['required', 'string', 'max:50', 'nullable'],
            
            'requires_claim_note'                  => ['required', 'boolean', 'nullable'],
            'requires_supervisor'                  => ['required', 'boolean', 'nullable'],
            'requires_authorization'               => ['required', 'boolean', 'nullable'],
            
            'service_group_1_id'                   => ['required', 'integer'],
            'service_group_2_id'                   => ['required', 'integer'],
            'service_type_id'                      => ['required', 'integer'],
            'service_type_of_service_id'           => ['required', 'integer'],
            'service_rev_center_id'                => ['required', 'integer'],
            'service_stmt_description_id'          => ['required', 'integer'],
            'service_special_instruction_id'       => ['required', 'integer', 'nullable'],
            'std_price'                            => ['required', 'numeric'],

            'billing_company_id'                   => [Rule::requiredIf(auth()->user()->hasRole('superuser')), 'integer', 'nullable'],
            'company_id'                           => ['required', 'integer'],

            'insurance_plans'                      => ['required', 'array'],
            'insurance_plans.*.price'              => ['required', 'numeric'],
            
            'insurance_plans.*.aliance'            => ['sometimes', 'required', 'array'],
            'insurance_plans.*.aliance.price'      => ['sometimes', 'required', 'number'],
            'insurance_plans.*.aliance.percentage' => ['sometimes', 'required', 'boolean'],

            'public_note'               => ['nullable', 'string'],
        ];
    }
}
