<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\KeyboardShortcut;
use Illuminate\Database\Seeder;

/** @todo change to chunk insert */
final class KeyboardShortcutSeeder extends Seeder
{
    public function run(): void
    {
        $keyboardShortcuts = json_decode(\File::get('database/data/KeyboardShortcuts.json'));

        foreach ($keyboardShortcuts as $keyboardShortcut) {
            KeyboardShortcut::updateOrCreate([
                    'default_key' => $keyboardShortcut->default_key,
                ], [
                    'description' => $keyboardShortcut->description,
                    'shortcut_type' => $keyboardShortcut->shortcut_type,
                    'module' => $keyboardShortcut->module,
                ]);
        }
    }
}
