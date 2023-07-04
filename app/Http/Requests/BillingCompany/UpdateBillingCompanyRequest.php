<?php

declare(strict_types=1);

namespace App\Http\Requests\BillingCompany;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class UpdateBillingCompanyRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:50',
                Rule::unique('billing_companies')->where(fn (Builder $query) => $query->where('id', '!=', $this->route('billing_company')))
            ],
            'address' => ['nullable', 'array'],
            'contact' => ['required', 'array'],
            'contact.phone' => ['nullable', 'string'],
            'contact.mobile' => ['nullable', 'string'],
            'contact.fax' => ['nullable', 'string'],
            'contact.email' => ['required', 'email:rfc'],
            'contact.contact_name' => ['nullable', 'string'],
            'abbreviation' => ['nullable', 'string'],
        ];
    }
}
