<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Http\Casts\Claims\CheckStatusRequestWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class ClaimCheckStatusRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = CheckStatusRequestWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'response_details' => ['nullable', 'string'],
            'interface_type' => ['nullable', 'string'],
            'interface' => ['nullable', 'string'],
            'consultation_date' => ['nullable', 'date'],
            'resolution_time' => ['nullable', 'date'],
            'past_due_date' => ['nullable', 'date'],
            'private_note' => ['required', 'string'],
            'follow_up_date' => ['required', 'date'],
            'department_responsibility_id' => ['nullable', 'integer'],
            'insurance_policy_id' => ['required', 'integer'],
        ];
    }
}
