<?php

declare(strict_types=1);

namespace App\Http\Resources\BillingCompany;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class KeyboardShortcutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'shortcut_type' => $this->shortcut_type,
            'module' => $this->module,
            'key' => $this->billingCompanyKey($request->billing_company?->id ?? $request->billing_company),
            'default_key' => $this->default_key,
        ];
    }
}
