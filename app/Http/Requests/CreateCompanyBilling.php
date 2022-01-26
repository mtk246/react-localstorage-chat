<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyBilling extends FormRequest
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
            "name" => "required|string|unique:billing_companies,name|max:50",
            "code" => "required|unique:billing_companies,code|string",
            "address" => "required|array",
            "contact" => "required|array"
        ];
    }
}
