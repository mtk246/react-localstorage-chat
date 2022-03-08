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
            'username'   => "sometimes|string|max:20",
            'email'      => "sometimes|email:rfc",
            'sex'        => "sometimes|string|max:1",
            'firstName'  => "sometimes|string|max:20",
            'lastName'   => "sometimes|string|max:20",
            'middleName' => "sometimes|string|max:20",
            'company-billing' => "sometimes|numeric",
            'roles'      => "sometimes|array",
            'ssn'        => "sometimes|string",
            'dateOfBirth'=> "sometimes|date",
            "address"           => "sometimes|array",
            'address.address'   => "sometimes|string",
            'address.city'  => "sometimes|string",
            'address.state' => "sometimes|string",
            'address.zip'   => "sometimes|numeric",
            "contact"       => "sometimes|array",
            "contact.phone" => "sometimes|string",
            "contact.fax"   => "sometimes|string",
            "contact.email" => "sometimes|email:rfc",
        ];
    }
}
