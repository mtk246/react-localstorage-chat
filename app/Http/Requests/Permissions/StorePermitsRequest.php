<?php

declare(strict_types=1);

namespace App\Http\Requests\Permissions;

use App\Http\Casts\Permissions\PermissionWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class StorePermitsRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = PermissionWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'permits' => ['required', 'array'],
        ];
    }
}
