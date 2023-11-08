<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\ColorTypeInterface;
use App\Enums\Traits\HasColorAttributes;

enum ClaimStatusType: string implements ColorTypeInterface
{
    use HasColorAttributes;

    #[ColorAttribute('#808080')]
    #[NameAttribute('Draft')]
    #[PublicAttribute(true)]
    case DRAFT = 'Draft';

    #[ColorAttribute('#FEA54C')]
    #[NameAttribute('Not submitted')]
    #[PublicAttribute(true)]
    case NOT_SUBMITTED = 'Not submitted';

    #[ColorAttribute('#FFE18D')]
    #[NameAttribute('Submitted')]
    #[PublicAttribute(true)]
    case SUBMITTED = 'Submitted';

    #[ColorAttribute('#87F8BA')]
    #[NameAttribute('Approved')]
    #[PublicAttribute(true)]
    case APPROVED = 'Approved';

    #[ColorAttribute('#87F8BA')]
    #[NameAttribute('Complete')]
    #[PublicAttribute(true)]
    case COMPLETE = 'Complete';

    #[ColorAttribute('#FC8989')]
    #[NameAttribute('Rejected')]
    #[PublicAttribute(true)]
    case REJECTED = 'Rejected';

    #[ColorAttribute('#FC8989')]
    #[NameAttribute('Denied')]
    #[PublicAttribute(true)]
    case DENIED = 'Denied';
}
