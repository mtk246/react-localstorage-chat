<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class

CreateInsurancePlanRequest extends FormRequest
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
            "ins_type" => "required|string",
            "name" => "required|string|unique:insurance_plans,name",
            "note" => "required|string",
            "plan_type" => "required|string",
            "cap_group" => "required|string",
            "accept_assign" => "required|boolean",
            "pre_authorization" => "required|boolean",
            "file_zero" => "required|boolean",
            "referral_required" => "required|boolean",
            "accrue_patient_resp" => "required|boolean",
            "require_abn" => "required|boolean",
            "pqrs_eligible" => "required|boolean",
            "allow_attached_files" => "required|boolean",
            "eff_date" => "required|date",
            "charge_using" => "required|string",
            "format" => "required|string",
            "method" => "required|string",
            "naic" => "required|string",
            "insurance_company_id" => "required|integer",
        ];
    }
}
