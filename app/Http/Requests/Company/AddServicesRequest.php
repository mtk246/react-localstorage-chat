<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\Models\Company\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class AddServicesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'services'                          => ['required', 'array'],
            'services.*.billing_company_id'     => ['nullable', 'integer'],
            'services.*.procedure_id'           => ['required', 'integer'],
            'services.*.modifier_id'            => ['nullable', 'integer'],
            'services.*.price'                  => ['required', 'numeric'],
            'services.*.mac'                    => ['nullable', 'string'],
            'services.*.locality_number'        => ['nullable', 'numeric'],
            'services.*.state'                  => ['nullable', 'string'],
            'services.*.fsa'                    => ['nullable', 'string'],
            'services.*.counties'               => ['nullable', 'string'],
            'services.*.insurance_label_fee_id' => ['nullable', 'integer'],
            'services.*.price_percentage'       => ['nullable', 'numeric'],
            'services.*.clia'                   => ['nullable', 'string'],
            'services.*.medications'            => ['nullable', 'array'],
            'services.*.medications.*.date'     => ['required_with:services.*.medications', 'date'],
            'services.*.medications.*.drug_code'=> ['required_with:services.*.medications', 'string'],
            'services.*.medications.*.batch'    => ['required_with:services.*.medications', 'string'],
            'services.*.medications.*.quantity' => ['required_with:services.*.medications', 'integer'],
            'services.*.medications.*.frequency'=> ['required_with:services.*.medications', 'integer'],
        ];
    }

    public function getservices(): Collection {
        return collect($this->list)
            ->map(fn(array $item) => new Service($item));
    }
}
