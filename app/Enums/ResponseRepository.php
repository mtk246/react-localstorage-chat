<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResponseRepository extends Enum
{
    public const OptionOne = 0;
    public const OptionTwo = 1;
    public const OptionThree = 2;
}
