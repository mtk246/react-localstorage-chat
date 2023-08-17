<?php

declare(strict_types=1);

namespace App\Actions\BillingCompany;

use App\Http\Resources\BillingCompany\KeyboardShortcutResource;
use App\Models\KeyboardShortcut;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetKeyboardShortcut
{
    public function getAll(): AnonymousResourceCollection
    {
        return KeyboardShortcutResource::collection(KeyboardShortcut::all());
    }

    public function getSingle(int $shortcut_id): KeyboardShortcutResource
    {
        $keyboardShortcut = KeyboardShortcut::query()->find($shortcut_id);

        return new KeyboardShortcutResource($keyboardShortcut);
    }
}
