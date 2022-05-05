<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IpRestrictionRequest extends FormRequest
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
        $entity = $this->entity;
        return [
            'ip_restriction_mults'                => ['required', 'array'],
            'ip_restriction_mults.*.ip_beginning' => ['required', 'string'],
            'ip_restriction_mults.*.ip_finish'    => ['nullable', 'string'],
            'ip_restriction_mults.*.rank'         => ['required', 'boolean'],


            'entity'             => ['required', 'string'],
            'billing_company_id' => [Rule::requiredIf(auth()->user()->hasRole('superuser')),'integer', 'nullable'],

            'users'              => [Rule::requiredIf(function () use ($entity) {
                return ($entity == 'user');
            }), 'array'],
            'roles'              => [Rule::requiredIf(function () use ($entity) {
                return ($entity == 'role');
            }), 'array'],
        ];
    }
}
