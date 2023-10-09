<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\User\UserType;
use App\Http\Casts\User\StoreUserWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\OnlyRoleIf;
use App\Rules\ValidRoleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'profile.id' => ['nullable', 'integer'],
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
            'roles.*' => ['required', 'integer', new ValidRoleRule()],
            'user_type' => ['required', 'integer', new Enum(UserType::class)],

            'billing_company_id' => ['nullable', 'integer'],
            'memberships' => [
                Rule::requiredIf(in_array(3, $this->roles)),
                'nullable',
                'array',
            ],
            'memberships.*' => [
                'integer',
                'exists:membership_roles,id',
            ],

            'address' => ['required', 'array'],
            'address.address' => ['nullable', 'string'],
            'address.apt_suite' => ['nullable', 'string'],
            'address.country' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.zip' => ['nullable', 'string'],

            'contact' => ['required', 'array'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.phone' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'string'],
        ];
    }
}
