<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Http\Casts\Claims\DenialTrackingRequestWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class DenialTrackingRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = DenialTrackingRequestWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'interface_type' => ['required', 'integer'],
            'is_reprocess_claim' => ['nullable', 'boolean'],
            'is_contact_to_patient' => ['nullable', 'boolean'],
            'contact_through' => ['nullable', 'string'],
            'claim_number' => ['nullable', 'string'],
            'rep_name' => ['nullable', 'string'],
            'ref_number' => ['nullable', 'string'],
            'claim_status' => ['required', 'integer'],
            'claim_sub_status' => ['nullable', 'integer'],
            'tracking_date' => ['required', 'date'],
            'resolution_time' => ['nullable', 'date'],
            'past_due_date' => ['nullable', 'date'],
            'follow_up' => ['required', 'date'],
            'department_responsible' => ['nullable', 'string'],
            'policy_responsible' => ['required', 'string'],
            'response_details' => ['nullable', 'array'],
            'tracking_note' => ['required', 'string'],
        ];
    }
}
