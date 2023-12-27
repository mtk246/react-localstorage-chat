<?php

declare(strict_types=1);

namespace App\Http\Requests\Payments;

use App\Http\Casts\Payments\EobWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

/** @method EobWrapper casted() */
final class StorePaymentEob extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = EobWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'date' => 'nullable|date',
            'file_name' => 'required|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:pdf,jpg,jpeg,png',
        ];
    }
}
