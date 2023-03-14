<?php

declare(strict_types=1);

namespace App\Actions\BillingCompany;

use App\Models\BillingCompany;
use App\Models\BillingCompanyKeyboardShortcut;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class StoreKeyboardShortcut
{
    public function __construct(private GetKeyboardShortcut $getKeyboardShortcut)
    {
    }

    /** @param array<key, string> $data */
    public function invoke(array $data, BillingCompany $billingCompany): AnonymousResourceCollection
    {
        DB::transaction(function () use ($data, $billingCompany): void {
            $this->deleteCustomKeys($data['delete'] ?? [], $billingCompany);
            $this->updateKeys($data['update'] ?? [], $billingCompany);
        });

        return $this->getKeyboardShortcut->getAll();
    }

    /** @param array<key, string> $data */
    private function deleteCustomKeys(array $data, BillingCompany $billingCompany): void
    {
        foreach ($data as $keyboardShortcut) {
            $billingCompany->customKeyboardShortcuts()
                ->where('keyboard_shortcut_id', $keyboardShortcut['id'])
                ->delete();
        }
    }

    /** @param array<key, string> $data */
    private function updateKeys(array $data, BillingCompany $billingCompany): void
    {
        foreach ($data as $keyboardShortcut) {
            BillingCompanyKeyboardShortcut::query()
                ->updateOrCreate([
                    'keyboard_shortcut_id' => $keyboardShortcut['id'],
                    'billing_company_id' => $billingCompany->id,
                ], ['key' => $keyboardShortcut['key']]);
        }
    }
}
