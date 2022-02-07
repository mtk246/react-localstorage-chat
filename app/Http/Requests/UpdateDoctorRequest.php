<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            "user"            => "sometimes|array",
            "user.username"   => "sometimes|string|unique:users,username",
            "user.email"      => "sometimes|email:rfc|unique:users,email",
            "user.sex"        => "sometimes|string|max:1",
            "user.firstName"  => "sometimes|string|max:20",
            "user.lastName"   => "sometimes|string|max:20",
            "user.middleName" => "sometimes|string|max:20",
            "user.ssn"        => "sometimes|string",
            "user.dateOfBirth" => "sometimes|date",
            "doctor"     => "sometimes|array",
            "doctor.npi" => "sometimes|string|unique:doctors,npi",
            "doctor.speciality" => "sometimes|string",
            "doctor.taxonomy"   => "sometimes|string",
            "address"           => "sometimes|array",
            'address.address'   => "sometimes|string",
            'address.city'  => "sometimes|string",
            'address.state' => "sometimes|string",
            'address.zip'   => "sometimes|numeric",
            "contact"       => "sometimes|array",
            "contact.phone" => "sometimes|string",
            "contact.fax"   => "sometimes|string",
            "contact.email" => "sometimes|email:rfc",
            //"user_id"   => "required|integer"
        ];
    }
}
