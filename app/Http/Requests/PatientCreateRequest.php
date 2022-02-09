<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCreateRequest extends FormRequest
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
            "patient"                => "required|array",
            "patient.marital_status" => "required|string",
            "patient.driver_licence" => "required|string",
            "patient.dependent"      => "required|boolean",
            "patient.guardian_name"  => "required|string",
            "patient.guardian_phone" => "required|string",
            "patient.spuse_name"     => "required|string",
            "patient.employer"       => "required|string",
            "patient.employer_address" => "required|string",
            "patient.position"         => "required|string",
            "patient.phone_employer"   => "required|string",
            "patient.spuse_employer"   => "required|string",
            "patient.spuse_work_phone" => "required|string",
            "user"             => "required|array",
            "user.username"    => "required|string|unique:users,username",
            "user.email"       => "required|email:rfc|unique:users,email",
            "user.sex"         => "required|string|max:1",
            "user.firstName"   => "required|string|max:20",
            "user.lastName"    => "required|string|max:20",
            "user.middleName"  => "required|string|max:20",
            "user.ssn"         => "required|string",
            "user.dateOfBirth" => "required|date",
        ];
    }
}
