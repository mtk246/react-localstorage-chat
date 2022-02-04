<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            "npi" => "sometimes|string|unique:doctors,npi",
            "speciality" => "sometimes|string",
            "taxonomy"   => "sometimes|string",
            "user_id"    => "sometimes|integer"
        ];
    }
}
