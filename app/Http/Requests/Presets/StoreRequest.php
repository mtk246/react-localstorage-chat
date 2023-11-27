<?php

declare(strict_types=1);

namespace App\Http\Requests\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreRequestCast::class;

    public function rules(): array
    {
        return [
            'report_id' => 'nullable|exists:\App\Models\Reports\Report,id',
            'name' => 'required|string',
            'description' => 'string',
            'is_private' => 'required',
            'description' => 'nullable|string',
            'filter' => 'required',
        ];
    }
}
