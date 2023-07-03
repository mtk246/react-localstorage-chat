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

enum CategoryIVType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Disorders of thyroid gland')]
    #[RangeAttribute('E00-E07')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_THYROID_GLAND = 1;

    #[NameAttribute('Diabetes mellitus')]
    #[RangeAttribute('E08-E13')]
    #[PublicAttribute(true)]
    case DIABETES_MELLITUS = 2;

    #[NameAttribute('Other disorders of glucose regulation and pancreatic internal secretion')]
    #[RangeAttribute('E15-E16')]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS_OF_GLUCOSE_REGULATION = 3;

    #[NameAttribute('Disorders of other endocrine glands')]
    #[RangeAttribute('E20-E35')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_OTHER_ENDOCRINE_GLANDS = 4;

    #[NameAttribute('Intraoperative complications of endocrine system')]
    #[RangeAttribute('E36-E36')]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_COMPLICATIONS = 5;

    #[NameAttribute('Malnutrition')]
    #[RangeAttribute('E40-E46')]
    #[PublicAttribute(true)]
    case MALNUTRITION = 6;

    #[NameAttribute('Other nutritional deficiencies')]
    #[RangeAttribute('E50-E64')]
    #[PublicAttribute(true)]
    case OTHER_NUTRITIONAL_DEFICIENCIES = 7;

    #[NameAttribute('Overweight, obesity and other hyperalimentation')]
    #[RangeAttribute('E65-E68')]
    #[PublicAttribute(true)]
    case OVERWEIGHT_OBESITY = 8;

    #[NameAttribute('Metabolic disorders')]
    #[RangeAttribute('E70-E88')]
    #[PublicAttribute(true)]
    case METABOLIC_DISORDERS = 9;

    #[NameAttribute('Postprocedural endocrine and metabolic complications and disorders, not elsewhere classified')]
    #[RangeAttribute('E89-E89')]
    #[PublicAttribute(true)]
    case POSTPROCEDURAL_ENDOCRINE_METABOLIC = 10;
}
