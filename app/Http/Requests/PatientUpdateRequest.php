<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            "patient"                => "sometimes|array",
            "patient.marital_status" => "sometimes|string",
            "patient.driver_licence" => "sometimes|string",
            "patient.dependent"      => "sometimes|boolean",
            "patient.guardian_name"  => "sometimes|string",
            "patient.guardian_phone" => "sometimes|string",
            "patient.spuse_name"     => "sometimes|string",
            "patient.employer"       => "sometimes|string",
            "patient.employer_address" => "sometimes|string",
            "patient.position"         => "sometimes|string",
            "patient.phone_employer"   => "sometimes|string",
            "patient.spuse_employer"   => "sometimes|string",
            "patient.spuse_work_phone" => "sometimes|string",
            "user"            => "sometimes|array",
            "user.username"   => "sometimes|string",
            "user.email"      => "sometimes|email:rfc",
            "user.sex"        => "sometimes|string|max:1",
            "user.firstName"  => "sometimes|string|max:20",
            "user.lastName"   => "sometimes|string|max:20",
            "user.middleName" => "sometimes|string|max:20",
            "user.ssn"        => "sometimes|string",
            "user.dateOfBirth" => "sometimes|date"
        ];
    }
}
