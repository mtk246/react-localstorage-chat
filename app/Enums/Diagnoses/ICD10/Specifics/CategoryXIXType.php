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

enum CategoryXIXType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Injuries to the head')]
    #[RangeAttribute('S00-S09')]
    #[PublicAttribute(true)]
    case HEAD = 1;

    #[NameAttribute('Injuries to the neck')]
    #[RangeAttribute('S10-S19')]
    #[PublicAttribute(true)]
    case NECK = 2;

    #[NameAttribute('Injuries to the thorax')]
    #[RangeAttribute('S20-S29')]
    #[PublicAttribute(true)]
    case THORAX = 3;

    #[NameAttribute('Injuries to the abdomen, lower back, lumbar spine, pelvis and external genitals')]
    #[RangeAttribute('S30-S39')]
    #[PublicAttribute(true)]
    case ABDOMEN = 4;

    #[NameAttribute('Injuries to the shoulder and upper arm')]
    #[RangeAttribute('S40-S49')]
    #[PublicAttribute(true)]
    case SHOULDER = 5;

    #[NameAttribute('Injuries to the elbow and forearm')]
    #[RangeAttribute('S50-S59')]
    #[PublicAttribute(true)]
    case ELBOW = 6;

    #[NameAttribute('Injuries to the wrist, hand and fingers')]
    #[RangeAttribute('S60-S69')]
    #[PublicAttribute(true)]
    case WRIST = 7;

    #[NameAttribute('Injuries to the hip and thigh')]
    #[RangeAttribute('S70-S79')]
    #[PublicAttribute(true)]
    case HIP = 8;

    #[NameAttribute('Injuries to the knee and lower leg')]
    #[RangeAttribute('S80-S89')]
    #[PublicAttribute(true)]
    case KNEE = 9;

    #[NameAttribute('Injuries to the ankle and foot')]
    #[RangeAttribute('S90-S99')]
    #[PublicAttribute(true)]
    case ANKLE = 10;

    #[NameAttribute('Injuries involving multiple body regions')]
    #[RangeAttribute('T07-T07')]
    #[PublicAttribute(true)]
    case MULTIPLE_REGIONS = 11;

    #[NameAttribute('Injury of unspecified body region')]
    #[RangeAttribute('T14-T14')]
    #[PublicAttribute(true)]
    case UNSPECIFIED = 12;

    #[NameAttribute('Effects of foreign body entering through natural orifice')]
    #[RangeAttribute('T15-T19')]
    #[PublicAttribute(true)]
    case FOREIGN_BODY = 13;

    #[NameAttribute('Burns and corrosions of external body surface, specified by site')]
    #[RangeAttribute('T20-T25')]
    #[PublicAttribute(true)]
    case BURNS = 14;

    #[NameAttribute('Burns and corrosions confined to eye and internal organs')]
    #[RangeAttribute('T26-T28')]
    #[PublicAttribute(true)]
    case EYE_BURNS = 15;

    #[NameAttribute('Burns and corrosions of multiple and unspecified body regions')]
    #[RangeAttribute('T30-T32')]
    #[PublicAttribute(true)]
    case MULTIPLE_BURNS = 16;

    #[NameAttribute('Frostbite')]
    #[RangeAttribute('T33-T34')]
    #[PublicAttribute(true)]
    case FROSTBITE = 17;

    #[NameAttribute('Poisoning by, adverse effect of and underdosing of drugs, medicaments and biological substances')]
    #[RangeAttribute('T36-T50')]
    #[PublicAttribute(true)]
    case POISONING = 18;

    #[NameAttribute('Toxic effects of substances chiefly nonmedicinal as to source')]
    #[RangeAttribute('T51-T65')]
    #[PublicAttribute(true)]
    case TOXIC_EFFECTS = 19;

    #[NameAttribute('Other and unspecified effects of external causes')]
    #[RangeAttribute('T66-T78')]
    #[PublicAttribute(true)]
    case OTHER_EFFECTS = 20;

    #[NameAttribute('Certain early complications of trauma')]
    #[RangeAttribute('T79-T79')]
    #[PublicAttribute(true)]
    case COMPLICATIONS = 21;

    #[NameAttribute('Complications of surgical and medical care, not elsewhere classified')]
    #[RangeAttribute('T80-T88')]
    #[PublicAttribute(true)]
    case SURGICAL_COMPLICATIONS = 22;
}
