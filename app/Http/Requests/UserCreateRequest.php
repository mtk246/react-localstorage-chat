<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Casts\User\StoreUserWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\OnlyRoleIf;
use App\Rules\ValidRoleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreUserWrapper::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
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

            'email' => ['required', Rule::unique('users', 'email'), 'string', 'email:rfc'],
            'language' => ['nullable', 'string'],
            'roles' => ['required', 'array', new OnlyRoleIf()],
            'roles.*' => ['required', 'string', new ValidRoleRule()],

            'billing_company_id' => ['nullable', 'integer'],
            'memberships' => [
                Rule::requiredIf(in_array('Billing Worker', $this->roles)),
                'nullable',
                'array',
            ],
            'memberships.*' => [
                'integer',
                'exists:memberships_roles,id',
            ],

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
