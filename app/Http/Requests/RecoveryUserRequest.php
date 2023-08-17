<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Casts\User\RecoveryUserRequestCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;

final class RecoveryUserRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = RecoveryUserRequestCast::class;

    public function authorize(): bool
    {
        return true;
    }

    /** @return array<key, string> */
    public function rules(): array
    {
        return [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'birth_date' => 'required|date',
            'ssn' => 'nullable|string',
        ];
    }
}
