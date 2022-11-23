<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\OnlyRoleIf;

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
        $invalidRoles = ['Super User', 'Development Support'];
        $id = $this->route('id');
        return [
            'profile'               => ['required', 'array'],
            'profile.sex'           => ['required', 'string', 'max:1'],
            'profile.first_name'    => ['required', 'string', 'max:20'],
            'profile.last_name'     => ['required', 'string', 'max:20'],
            'profile.middle_name'   => ['nullable', 'string', 'max:20'],
            'profile.ssn'           => ['required', 'string'],
            'profile.date_of_birth' => ['required', 'date'],

            'profile.social_medias' => ['sometimes', 'array'],
            'profile.social_medias.*.name' => ['sometimes', 'string'],
            'profile.social_medias.*.link' => ['sometimes', 'string'],

            'email'                 => ['required', Rule::unique('users', 'email')->ignore($id), 'string', 'email:rfc'],
            'language'              => ['nullable', 'string'],
            'roles'                 => ['required', 'array', new OnlyRoleIf()],

            'company-billing' => [Rule::requiredIf(function () use ($roles, $invalidRoles) {
                return (!in_array_any($invalidRoles, $roles ?? $invalidRoles));
            }), 'integer', 'nullable'],

            'address'               => ['required', 'array'],
            'address.address'       => ['required', 'string'],
            'address.city'          => ['required', 'string'],
            'address.state'         => ['required', 'string'],
            'address.zip'           => ['required', 'string'],
            
            'contact'               => ['required', 'array'],
            'contact.mobile'        => ['nullable', 'string'],
            'contact.phone'         => ['nullable', 'string'],
            'contact.fax'           => ['nullable', 'string'],
            'contact.email'         => ['required', 'string']
        ];
    }
}
