<?php

declare(strict_types=1);

namespace App\Http\Requests\BillingCompany;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class StoreKeyboardShortcutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('is-admin')
            || Gate::allows('billingmanager', $this->billing_company);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'update' => 'nullable|array',
            'update.*.id' => 'required|integer|exists:\App\Models\KeyboardShortcut,id',
            'update.*.key' => 'required|string|max:20',
            'delete' => 'nullable|array',
            'delete.*.id' => 'required|integer|exists:\App\Models\KeyboardShortcut,id',
        ];
    }
}
