<?php

declare(strict_types=1);

namespace App\Http\Requests\Permissions;

use App\Http\Casts\Permissions\StoreMembershipWrapper;
use App\Http\Requests\Traits\HasCastedClass;
use App\Rules\RoleTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreRoleRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = StoreMembershipWrapper::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'billing_company_id' => [
                Rule::excludeIf(Gate::denies('is-admin')),
                'required',
                'integer',
                'exists:\App\Models\BillingCompany,id',
            ],
            'name' => 'required|string',
            'note' => 'nullable|string',
            'permissions' => 'required|array|exists:permissions,id',
            'type' => ['required', 'integer', new RoleTypeRule()],
        ];
    }
}
