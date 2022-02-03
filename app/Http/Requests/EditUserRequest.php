<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'username'       => "sometimes|string|max:20",
            'email'      => "sometimes|string|email:rfc",
            //'password' => "required|string|min:8",
            //'DOB'        => "sometimes|date",
            'sex'        => "sometimes|string|max:1",
            'firstName'  => "sometimes|string|max:20",
            'lastName'   => "sometimes|string|max:20",
            'middleName' => "sometimes|string|max:20",
            'roles'      => "sometimes|array",
            'ssn'        => "sometimes|string",
            'dateOfBirth'=> "sometimes|date",
        ];
    }
}
