<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryVIIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Diseases of external ear')]
    #[RangeAttribute('H60-H62')]
    #[PublicAttribute(true)]
    case EXTERNAL_EAR = 1;

    #[NameAttribute('Diseases of middle ear and mastoid')]
    #[RangeAttribute('H65-H75')]
    #[PublicAttribute(true)]
    case MIDDLE_EAR_MASTOID = 2;

    #[NameAttribute('Diseases of inner ear')]
    #[RangeAttribute('H80-H83')]
    #[PublicAttribute(true)]
    case INNER_EAR = 3;

    #[NameAttribute('Other disorders of ear')]
    #[RangeAttribute('H90-H94')]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS = 4;

    #[NameAttribute('Intraoperative and postprocedural complications and disorders of ear and mastoid process, not elsewhere classified')]
    #[RangeAttribute('H95-H95')]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_POSTPROCEDURAL = 5;
}
