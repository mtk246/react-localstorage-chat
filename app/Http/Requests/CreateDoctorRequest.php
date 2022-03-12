<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDoctorRequest extends FormRequest
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
            'user'              => ['required', 'array'],
            'user.username'     => ['required', 'string', Rule::unique('users', 'username')],
            'user.email'        => ['required', 'email:rfc', Rule::unique('users', 'email')],
            'user.sex'          => ['required', 'string', 'max:1'],
            'user.firstName'    => ['required', 'string', 'max:20'],
            'user.lastName'     => ['required', 'string', 'max:20'],
            'user.middleName'   => ['required', 'string', 'max:20'],
            'user.ssn'          => ['required', 'string', Rule::unique('users', 'ssn')],
            'user.dateOfBirth'  => ['required', 'date'],

            'doctor'            => ['required', 'array'],
            'doctor.npi'        => ['required', 'string', Rule::unique('doctors', 'npi')],
            'doctor.speciality' => ['required', 'string'],
            'doctor.taxonomy'   => ['required', 'string'],

            'address'           => ['required', 'array'],
            'address.address'   => ['required', 'string'],
            'address.city'      => ['required', 'string'],
            'address.state'     => ['required', 'string'],
            'address.zip'       => ['required', 'numeric'],

            'contact'           => ['required', 'array'],
            'contact.phone'     => ['required', 'string'],
            'contact.fax'       => ['required', 'string'],
            'contact.email'     => ['required', 'email:rfc'],
        ];
    }
}
