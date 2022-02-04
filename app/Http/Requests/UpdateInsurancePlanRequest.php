<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsurancePlanRequest extends FormRequest
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
            "ins_type" => "sometimes|string",
            "note" => "sometimes|string",
            "plan_type" => "sometimes|string",
            "cap_group" => "sometimes|string",
            "accept_assign" => "sometimes|boolean",
            "pre_authorization" => "sometimes|boolean",
            "file_zero_changes" => "sometimes|boolean",
            "referral_required" => "sometimes|boolean",
            "accrue_patient_resp" => "sometimes|boolean",
            "require_abn" => "sometimes|boolean",
            "pqrs_eligible" => "sometimes|boolean",
            "allow_attached_files" => "sometimes|boolean",
            "eff_date" => "sometimes|date",
            "charge_using" => "sometimes|string",
            "format" => "sometimes|string",
            "method" => "sometimes|string",
            "naic" => "sometimes|string",
            "insurance_company_id" => "sometimes|integer",
        ];
    }
}
