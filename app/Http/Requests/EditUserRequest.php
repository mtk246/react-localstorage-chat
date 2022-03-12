<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $roles = $this->roles;
        $invalidRoles = ['SUPER_USER', 'DEVELOPMENT_SUPPORT'];
        $id = $this->route('id');
        return [
            'username'        => ['required', Rule::unique('users', 'username')->ignore($id), 'string', 'max:20'],
            'email'           => ['required', Rule::unique('users', 'email')->ignore($id), 'string', 'email:rfc'],
            'sex'             => ['required', 'string', 'max:1'],
            'firstName'       => ['required', 'string', 'max:20'],
            'lastName'        => ['required', 'string', 'max:20'],
            'middleName'      => ['required', 'string', 'max:20'],
            'ssn'             => ['required', 'string'],
            'dateOfBirth'     => ['required', 'date'],
            'roles'           => ['sometimes', 'array'],
            'company-billing' => [Rule::requiredIf(function () use ($roles, $invalidRoles) {
                return (!in_array_any($invalidRoles, $roles ?? $invalidRoles));
            }), 'integer'],

            'address'         => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.city'    => ['required', 'string'],
            'address.state'   => ['required', 'string'],
            'address.zip'     => ['required', 'numeric'],
            'contact'         => ['required', 'array'],
            'contact.phone'   => ['required', 'string'],
            'contact.fax'     => ['required', 'string']
        ];
    }
}
