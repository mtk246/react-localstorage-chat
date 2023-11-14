<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class InterfaceType extends Enum
{
    public const CALL = 'call';
    public const WEBSITE = 'website';
    public const EMAIL = 'email';
    public const OTHER = 'other';
}
