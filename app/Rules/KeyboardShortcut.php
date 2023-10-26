<?php

declare(strict_types=1);

namespace App\Rules;

use App\Enums\InvalidKeyboardShortcut;
use App\Enums\KeyboardKey;
use Illuminate\Contracts\Validation\Rule;

final class KeyboardShortcut implements Rule
{
    /**
     * @param string $attribute
     */
    public function passes($attribute, $value): bool
    {
        if ($this->hasInvalidKeys($value) || $this->isInvalidkeyConbination($value)) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Invalid keyboard shortcut combination.';
    }

    private function hasInvalidKeys(string $shortcut): bool
    {
        $keys = explode(' + ', $shortcut);

        if (count($keys) > 3) {
            return true;
        }

        return array_reduce($keys, function ($carry, $key) {
            return !$carry
                ? !in_array($key, KeyboardKey::Values())
                : $carry;
        }, false);
    }

    private function isInvalidkeyConbination(string $shortcut): bool
    {
        return in_array($shortcut, InvalidKeyboardShortcut::Values());
    }
}
