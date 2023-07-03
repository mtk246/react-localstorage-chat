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

enum CategoryIIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Nutritional anemias')]
    #[RangeAttribute('D50-D53')]
    #[PublicAttribute(true)]
    case NUTRITIONAL_ANEMIAS = 1;

    #[NameAttribute('Hemolytic anemias')]
    #[RangeAttribute('D55-D59')]
    #[PublicAttribute(true)]
    case HEMOLYTIC_ANEMIAS = 2;

    #[NameAttribute('Aplastic and other anemias and other bone marrow failure syndromes')]
    #[RangeAttribute('D60-D64')]
    #[PublicAttribute(true)]
    case APLASTIC_AND_OTHER_ANEMIAS = 3;

    #[NameAttribute('Coagulation defects, purpura and other hemorrhagic conditions')]
    #[RangeAttribute('D65-D69')]
    #[PublicAttribute(true)]
    case COAGULATION_DEFECTS = 4;

    #[NameAttribute('Other disorders of blood and blood-forming organs')]
    #[RangeAttribute('D70-D77')]
    #[PublicAttribute(true)]
    case OTHER_BLOOD_DISORDERS = 5;

    #[NameAttribute('Intraoperative and postprocedural complications of the spleen')]
    #[RangeAttribute('D78-D78')]
    #[PublicAttribute(true)]
    case SPLEEN_COMPLICATIONS = 6;

    #[NameAttribute('Certain disorders involving the immune mechanism')]
    #[RangeAttribute('D80-D89')]
    #[PublicAttribute(true)]
    case IMMUNE_DISORDERS = 7;
}
