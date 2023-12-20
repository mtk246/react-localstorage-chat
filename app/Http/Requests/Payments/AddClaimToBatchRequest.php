<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use App\Http\Casts\Payments\AddClaimsToBachWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class AddClaimToBatchRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = AddClaimsToBachWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'payments' => 'nullable|array',
            'payments.*.id' => ['required', 'integer', Rule::exists('payments', 'id')->where(
                'payment_batch_id',
                $this->route()->parameter('batch')->id,
            )],
            'payments.*.claims' => 'nullable|array',
            'payments.*.claims.*' => ['required', 'integer', Rule::exists('claims', 'id')],
        ];
    }
}
