<?php

declare(strict_types=1);

namespace App\Enums\Traits;

trait EnumToArray
{
    /** @return string[] */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /** @return string[] */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /** @return array<string, string> */
    public static function toArray(): array
    {
        return array_combine(self::values(), self::names());
    }
}
