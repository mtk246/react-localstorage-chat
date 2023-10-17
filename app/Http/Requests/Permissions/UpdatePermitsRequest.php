<?php

declare(strict_types=1);

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

final class UpdatePermitsRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'permissions' => 'required|array|exists:permissions,id',
        ];
    }
}
