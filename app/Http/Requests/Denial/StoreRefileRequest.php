<?php

declare(strict_types=1);

namespace App\Http\Requests\Denial;

use App\Http\Casts\Claims\DenialRefileWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRefileRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = DenialRefileWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'refile_id' => 'nullable|numeric',
            'refile_type' => 'required|numeric',
            'policy_id' => 'nullable',
            'is_cross_over' => 'nullable|boolean',
            'cross_over_date' => 'nullable|date',
            'note' => 'required|string',
            'original_claim_id' => 'nullable',
            'refile_reason' => 'nullable|numeric',
            'claim_id' => 'required|numeric',
        ];
    }
}
