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

enum CategoryXVIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Newborn affected by maternal factors and by complications of pregnancy, labor, and delivery')]
    #[RangeAttribute('P00-P04')]
    #[PublicAttribute(true)]
    case NEWBORN_MATERNAL = 1;

    #[NameAttribute('Disorders of newborn related to length of gestation and fetal growth')]
    #[RangeAttribute('P05-P08')]
    #[PublicAttribute(true)]
    case NEWBORN_GESTATION = 2;

    #[NameAttribute('Abnormal findings on neonatal screening')]
    #[RangeAttribute('P09-P09')]
    #[PublicAttribute(true)]
    case NEWBORN_SCREENING = 3;

    #[NameAttribute('Birth trauma')]
    #[RangeAttribute('P10-P15')]
    #[PublicAttribute(true)]
    case NEWBORN_TRAUMA = 4;

    #[NameAttribute('Respiratory and cardiovascular disorders specific to the perinatal period')]
    #[RangeAttribute('P19-P29')]
    #[PublicAttribute(true)]
    case NEWBORN_RESPIRATORY = 5;

    #[NameAttribute('Infections specific to the perinatal period')]
    #[RangeAttribute('P35-P39')]
    #[PublicAttribute(true)]
    case NEWBORN_INFECTIONS = 6;

    #[NameAttribute('Hemorrhagic and hematological disorders of newborn')]
    #[RangeAttribute('P50-P61')]
    #[PublicAttribute(true)]
    case NEWBORN_HEMORRHAGIC = 7;

    #[NameAttribute('Transitory endocrine and metabolic disorders specific to newborn')]
    #[RangeAttribute('P70-P74')]
    #[PublicAttribute(true)]
    case NEWBORN_ENDOCRINE = 8;

    #[NameAttribute('Digestive system disorders of newborn')]
    #[RangeAttribute('P76-P78')]
    #[PublicAttribute(true)]
    case NEWBORN_DIGESTIVE = 9;

    #[NameAttribute('Conditions involving the integument and temperature regulation of newborn')]
    #[RangeAttribute('P80-P83')]
    #[PublicAttribute(true)]
    case NEWBORN_INTEGUMENT = 10;

    #[NameAttribute('Other problems with newborn')]
    #[RangeAttribute('P84-P84')]
    #[PublicAttribute(true)]
    case NEWBORN_OTHER = 11;

    #[NameAttribute('Other disorders originating in the perinatal period')]
    #[RangeAttribute('P90-P96')]
    #[PublicAttribute(true)]
    case PERINATAL_OTHER = 12;
}
