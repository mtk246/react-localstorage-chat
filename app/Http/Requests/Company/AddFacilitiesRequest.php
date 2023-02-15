<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class AddFacilitiesRequest extends FormRequest
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
     * @return array <string, mixed>
     */
    public function rules()
    {
        return [
            'facilities'                      => ['required', 'array'],
            'facilities.*.billing_company_id' => ['nullable', 'integer'],
            'facilities.*.facility_id'        => ['required', 'integer'],
        ];
    }
}
