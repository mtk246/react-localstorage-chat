<?php

declare(strict_types=1);

namespace App\Http\Requests\Procedure;

use App\Enums\Procedure\ClasificationType;
use App\Models\Procedure;
use App\Rules\IUnique;
use App\Rules\MacLocalityFeeRequired;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProcedureCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'string', 'max:50', new IUnique(Procedure::class, 'code')],
            'description' => ['required', 'string'],
            'insurance_companies' => ['nullable', 'array'],
            'specific_insurance_company' => ['boolean', 'nullable'],
            'start_date' => ['required', 'date'],

            'type' => ['required', new Enum(ClasificationType::class)],
            'clasifications' => ['required', 'array'],
            'clasifications.general' => ['required', 'integer'],
            'clasifications.specific' => ['required', 'integer'],
            'clasifications.sub_specific' => ['nullable', 'integer'],

            'mac_localities' => ['nullable', 'array', new MacLocalityFeeRequired()],
            'mac_localities.*.mac' => ['sometimes', 'string'],
            'mac_localities.*.modifier_id' => ['nullable', 'integer'],
            'mac_localities.*.locality_number' => ['sometimes', 'numeric'],
            'mac_localities.*.state' => ['sometimes', 'string'],
            'mac_localities.*.fsa' => ['sometimes', 'string'],
            'mac_localities.*.counties' => ['sometimes', 'string'],

            'mac_localities.*.procedure_fees' => ['nullable', 'array'],
            'mac_localities.*.procedure_fees.non_facility_price' => ['nullable', 'numeric'],
            'mac_localities.*.procedure_fees.facility_price' => ['nullable', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_limiting_charge' => ['nullable', 'numeric'],
            'mac_localities.*.procedure_fees.facility_limiting_charge' => ['nullable', 'numeric'],

            'mac_localities.*.procedure_fees.facility_rate' => ['nullable', 'numeric'],
            'mac_localities.*.procedure_fees.non_facility_rate' => ['nullable', 'numeric'],

            'procedure_considerations' => ['nullable', 'array'],
            'procedure_considerations.gender_id' => ['nullable', 'integer'],
            'procedure_considerations.age_init' => ['nullable', 'numeric'],
            'procedure_considerations.age_end' => ['nullable', 'numeric'],
            'procedure_considerations.discriminatory_id' => ['nullable', 'numeric'],

            'modifiers' => ['nullable', 'array'],
            'diagnoses' => ['nullable', 'array'],
            'note' => ['nullable', 'string'],
        ];
    }
}
