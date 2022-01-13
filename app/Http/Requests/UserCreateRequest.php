<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name'  => "required|string|max:20",
            'email' => "required|string|email:rfc",
            'password' => "required|string|min:8",
            'DOB' => "required|date",
            'sex' => "required|string|max:1",
            'firstName'  => "required|string|max:20",
            'lastName'   => "required|string|max:20",
            'middleName' => "required|string|max:20",
            'roles'      => "sometimes|array",
            'company_billing' => "sometimes|string|max:50"
        ];
    }
}
