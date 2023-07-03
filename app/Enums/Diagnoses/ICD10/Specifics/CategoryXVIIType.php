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

enum CategoryXVIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Congenital malformations of the nervous system')]
    #[RangeAttribute('Q00-Q07')]
    #[PublicAttribute(true)]
    case NERVOUS_SYSTEM = 1;

    #[NameAttribute('Congenital malformations of eye, ear, face and neck')]
    #[RangeAttribute('Q10-Q18')]
    #[PublicAttribute(true)]
    case EYE_EAR_FACE_NECK = 2;

    #[NameAttribute('Congenital malformations of the circulatory system')]
    #[RangeAttribute('Q20-Q28')]
    #[PublicAttribute(true)]
    case CIRCULATORY_SYSTEM = 3;

    #[NameAttribute('Congenital malformations of the respiratory system')]
    #[RangeAttribute('Q30-Q34')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SYSTEM = 4;

    #[NameAttribute('Cleft lip and cleft palate')]
    #[RangeAttribute('Q35-Q37')]
    #[PublicAttribute(true)]
    case CLEFT_LIP_PALATE = 5;

    #[NameAttribute('Other congenital malformations of the digestive system')]
    #[RangeAttribute('Q38-Q45')]
    #[PublicAttribute(true)]
    case DIGESTIVE_SYSTEM = 6;

    #[NameAttribute('Congenital malformations of genital organs')]
    #[RangeAttribute('Q50-Q56')]
    #[PublicAttribute(true)]
    case GENITAL_ORGANS = 7;

    #[NameAttribute('Congenital malformations of the urinary system')]
    #[RangeAttribute('Q60-Q64')]
    #[PublicAttribute(true)]
    case URINARY_SYSTEM = 8;

    #[NameAttribute('Congenital malformations and deformations of the musculoskeletal system')]
    #[RangeAttribute('Q65-Q79')]
    #[PublicAttribute(true)]
    case MUSCULOSKELETAL_SYSTEM = 9;

    #[NameAttribute('Other congenital malformations of the digestive system')]
    #[RangeAttribute('Q80-Q89')]
    #[PublicAttribute(true)]
    case OTHER_DIGESTIVE_SYSTEM = 10;

    #[NameAttribute('Chromosomal abnormalities, not elsewhere classified')]
    #[RangeAttribute('Q90-Q99')]
    #[PublicAttribute(true)]
    case CHROMOSOMAL_ABNORMALITIES = 11;
}
