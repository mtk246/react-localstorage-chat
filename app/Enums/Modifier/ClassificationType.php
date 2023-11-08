<?php

declare(strict_types=1);

namespace App\Enums\Modifier;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\ColorTypeInterface;
use App\Enums\Traits\HasColorAttributes;

enum ClassificationType: int implements ColorTypeInterface
{
    use HasColorAttributes;

    #[ColorAttribute('#FFFFFF')]
    #[NameAttribute('General')]
    #[PublicAttribute(true)]
    case GENERAL = 1;

    #[ColorAttribute('#ff9895')]
    #[NameAttribute('Advance Beneficiary Notice of Noncoverage (ABN)')]
    #[PublicAttribute(true)]
    case ABN = 2;

    #[ColorAttribute('#980E04')]
    #[NameAttribute('Ambulance Origin/Destination')]
    #[PublicAttribute(true)]
    case AMBULANCE = 3;

    #[ColorAttribute('#FCC084')]
    #[NameAttribute('Anatomic')]
    #[PublicAttribute(true)]
    case ANATOMIC = 4;

    #[ColorAttribute('#F85200')]
    #[NameAttribute('Anesthesia')]
    #[PublicAttribute(true)]
    case ANESTHESIA = 5;

    #[ColorAttribute('#FDFF8C')]
    #[NameAttribute('Assist at Surgery')]
    #[PublicAttribute(true)]
    case ASSIST_SURGERY = 6;

    #[ColorAttribute('#FBE661')]
    #[NameAttribute('Chiropractic')]
    #[PublicAttribute(true)]
    case CHIROPRACTIC = 7;

    #[ColorAttribute('#93F9C1')]
    #[NameAttribute('Physician Quality Reporting System (PQRS)')]
    #[PublicAttribute(true)]
    case PQRS = 8;

    #[ColorAttribute('#1B6D49')]
    #[NameAttribute('Telehealth')]
    #[PublicAttribute(true)]
    case TELEHEALTH = 9;

    #[ColorAttribute('#B7EDFF')]
    #[NameAttribute('Therapy')]
    #[PublicAttribute(true)]
    case THERAPY = 10;

    #[ColorAttribute('#018ECC')]
    #[NameAttribute('Other')]
    #[PublicAttribute(true)]
    case OTHER = 11;

    #[ColorAttribute('#808080')]
    #[NameAttribute('Draft')]
    #[PublicAttribute(true)]
    const DRAFT = 'Draft';

    #[ColorAttribute('#FEA54C')]
    #[NameAttribute('Not submitted')]
    #[PublicAttribute(true)]
    const NOT_SUBMITTED = 'Not submitted';

    #[ColorAttribute('#FFE18D')]
    #[NameAttribute('Submitted')]
    #[PublicAttribute(true)]
    const SUBMITTED = 'Submitted';

    #[ColorAttribute('#87F8BA')]
    #[NameAttribute('Approved')]
    #[PublicAttribute(true)]
    const APPROVED = 'Approved';

    #[ColorAttribute('#87F8BA')]
    #[NameAttribute('Complete')]
    #[PublicAttribute(true)]
    const COMPLETE = 'Complete';

    #[ColorAttribute('#FC8989')]
    #[NameAttribute('Rejected')]
    #[PublicAttribute(true)]
    const REJECTED = 'Rejected';

    #[ColorAttribute('#FC8989')]
    #[NameAttribute('Denied')]
    #[PublicAttribute(true)]
    const DENIED = 'Denied';
}
