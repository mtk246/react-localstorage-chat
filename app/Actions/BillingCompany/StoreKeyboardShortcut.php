<?php

declare(strict_types=1);

namespace App\Actions\BillingCompany;

use App\Models\BillingCompany;
use App\Models\CustomKeyboardShortcuts;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class StoreKeyboardShortcut
{
    public function __construct(private GetKeyboardShortcut $getKeyboardShortcut)
    {
    }

    /**
     * @param array<key, string> $data
     * @param BillingCompany|User $shortcutable
     */
    public function invoke(array $data, $shortcutable): AnonymousResourceCollection
    {
        DB::transaction(function () use ($data, $shortcutable): void {
            $this->deleteCustomKeys($data['delete'] ?? [], $shortcutable);
            $this->updateKeys($data['update'] ?? [], $shortcutable);
        });

        return $this->getKeyboardShortcut->getAll();
    }

    /**
     * @param array<key, string> $data
     * @param BillingCompany|User $shortcutable
     */
    private function deleteCustomKeys(array $data, $shortcutable): void
    {
        foreach ($data as $keyboardShortcut) {
            $shortcutable->customKeyboardShortcuts()
                ->where('keyboard_shortcut_id', $keyboardShortcut['id'])
                ->delete();
        }
    }

    /**
     * @param array<key, string> $data
     * @param BillingCompany|User $shortcutable
     */
    private function updateKeys(array $data, $shortcutable): void
    {
        foreach ($data as $keyboardShortcut) {
            CustomKeyboardShortcuts::query()
                ->updateOrCreate([
                    'keyboard_shortcut_id' => $keyboardShortcut['id'],
                    'shortcutable_type' => get_class($shortcutable),
                    'shortcutable_id' => $shortcutable->id,
                ], ['key' => $keyboardShortcut['key']]);
        }
    }
}
