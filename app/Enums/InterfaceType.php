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

    public const SECONDARY_INSURANCE = 'submit_to_secondary_insurance';
    public const CORRECTED_CLAIMS = 'corrected_claims';
    public const REFILE_ANOTHER_REASONS = 'refile_another_reason';
}
