<?php

declare(strict_types=1);

namespace App\Http\Requests\Claim;

use App\Http\Casts\Claims\ChangeStatusRequestWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class ClaimChangeStatusRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = ChangeStatusRequestWrapper::class;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'status_id' => ['required', 'integer'],
            'sub_status_id' => ['nullable', 'integer'],
            'private_note' => ['nullable', 'string'],
        ];
    }
}
