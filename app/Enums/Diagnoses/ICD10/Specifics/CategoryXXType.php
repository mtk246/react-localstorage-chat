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

enum CategoryXXType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute("Provisional assignment of new diseases of uncertain etiology or emergency use")]
    #[RangeAttribute("U00-U49")]
    #[PublicAttribute(true)]
    case PROVISIONAL_ASSIGNMENT = 1;

    #[NameAttribute("Provisional assignment of new diseases of uncertain etiology or emergency use")]
    #[RangeAttribute("U50-U85")]
    #[PublicAttribute(true)]
    case PROVISIONAL_ASSIGNMENT2 = 2;
}
