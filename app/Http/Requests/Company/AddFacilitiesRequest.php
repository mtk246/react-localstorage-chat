<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Casts\Company\FacilityCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AddFacilitiesRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = FacilityCast::class;

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
            'facilities' => ['required', 'array'],
            'facilities.*.billing_company_id' => [
                Rule::requiredIf(Gate::check('is-admin')),
                'integer',
            ],
            'facilities.*.facility_id' => ['required', 'integer'],
        ];
    }
}
