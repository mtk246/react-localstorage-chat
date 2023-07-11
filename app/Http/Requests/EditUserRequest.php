<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\OnlyRoleIf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

        return [
            'profile' => ['required', 'array'],
            'profile.sex' => ['required', 'string', 'max:1'],
            'profile.first_name' => ['required', 'string', 'max:20'],
            'profile.last_name' => ['required', 'string', 'max:20'],
            'profile.middle_name' => ['nullable', 'string', 'max:20'],
            'profile.ssn' => ['nullable', 'string'],
            'profile.date_of_birth' => ['required', 'date'],

            'profile.social_medias' => ['sometimes', 'array'],
            'profile.social_medias.*.name' => ['sometimes', 'string'],
            'profile.social_medias.*.link' => ['sometimes', 'string'],

            'email' => ['required', Rule::unique('users', 'email')->ignore($id), 'string', 'email:rfc'],
            'language' => ['nullable', 'string'],
            'roles' => ['required', 'array', new OnlyRoleIf()],

            'company-billing' => ['nullable', 'integer'],

            'address' => ['required', 'array'],
            'address.address' => ['required', 'string'],
            'address.apt_suite' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip' => ['required', 'string'],

            'contact' => ['required', 'array'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', 'string'],
        ];
    }
}
