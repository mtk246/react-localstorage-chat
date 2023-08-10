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

enum CategoryXVIIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Symptoms and signs involving the circulatory and respiratory systems')]
    #[RangeAttribute('R00', 'R09')]
    #[PublicAttribute(true)]
    case CIRCULATORY_RESPIRATORY = 1;

    #[NameAttribute('Symptoms and signs involving the digestive system and abdomen')]
    #[RangeAttribute('R10', 'R19')]
    #[PublicAttribute(true)]
    case DIGESTIVE_ABDOMEN = 2;

    #[NameAttribute('Symptoms and signs involving the skin and subcutaneous tissue')]
    #[RangeAttribute('R20', 'R23')]
    #[PublicAttribute(true)]
    case SKIN_SUBCUTANEOUS = 3;

    #[NameAttribute('Symptoms and signs involving the nervous and musculoskeletal systems')]
    #[RangeAttribute('R25', 'R29')]
    #[PublicAttribute(true)]
    case NERVOUS_MUSCULOSKELETAL = 4;

    #[NameAttribute('Symptoms and signs involving the genitourinary system')]
    #[RangeAttribute('R30', 'R39')]
    #[PublicAttribute(true)]
    case GENITOURINARY = 5;

    #[NameAttribute('Symptoms and signs involving cognition, perception, emotional state and behavior')]
    #[RangeAttribute('R40', 'R46')]
    #[PublicAttribute(true)]
    case COGNITION_PERCEPTION_EMOTION = 6;

    #[NameAttribute('Symptoms and signs involving speech and voice')]
    #[RangeAttribute('R47', 'R49')]
    #[PublicAttribute(true)]
    case SPEECH_VOICE = 7;

    #[NameAttribute('General symptoms and signs')]
    #[RangeAttribute('R50', 'R69')]
    #[PublicAttribute(true)]
    case GENERAL_SYMPTOMS = 8;

    #[NameAttribute('Abnormal findings on examination of blood, without diagnosis')]
    #[RangeAttribute('R70', 'R79')]
    #[PublicAttribute(true)]
    case ABNORMAL_BLOOD = 9;

    #[NameAttribute('Abnormal findings on examination of urine, without diagnosis')]
    #[RangeAttribute('R80', 'R82')]
    #[PublicAttribute(true)]
    case ABNORMAL_URINE = 10;

    #[NameAttribute('Abnormal findings on examination of other body fluids, substances and tissues, without diagnosis')]
    #[RangeAttribute('R83', 'R89')]
    #[PublicAttribute(true)]
    case ABNORMAL_BODY_FLUIDS = 11;

    #[NameAttribute('Abnormal findings on diagnostic imaging and in function studies, without diagnosis')]
    #[RangeAttribute('R90', 'R94')]
    #[PublicAttribute(true)]
    case ABNORMAL_IMAGING = 12;

    #[NameAttribute('Abnormal tumor markers')]
    #[RangeAttribute('R97', 'R97')]
    #[PublicAttribute(true)]
    case ABNORMAL_TUMOR_MARKERS = 13;

    #[NameAttribute('Ill-defined and unknown cause of mortality')]
    #[RangeAttribute('R99', 'R99')]
    #[PublicAttribute(true)]
    case UNKNOWN_CAUSE_OF_MORTALITY = 14;
}
