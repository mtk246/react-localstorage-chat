<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum AnesthesiaType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[RangeAttribute('00100', '00222')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;

    #[NameAttribute('Anesthesia for Procedures on the Neck')]
    #[RangeAttribute('00300', '00352')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_NECK = 2;

    #[NameAttribute('Anesthesia for Procedures on the Thorax (Chest Wall and Shoulder Girdle)')]
    #[RangeAttribute('00400', '00474')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_THORAX = 3;

    #[NameAttribute('Anesthesia for Intrathoracic Procedures')]
    #[RangeAttribute('00500', '00580')]
    #[PublicAttribute(true)]
    case INTRATHORACIC_PROCEDURES = 4;

    #[NameAttribute('Anesthesia for Procedures on the Spine and Spinal Cord')]
    #[RangeAttribute('00600', '00670')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_SPINE_AND_SPINAL_CORD = 5;

    #[NameAttribute('Anesthesia for Procedures on the Upper Abdomen')]
    #[RangeAttribute('00700', '00797')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_ABDOMEN = 6;

    #[NameAttribute('Anesthesia for Procedures on the Lower Abdomen')]
    #[RangeAttribute('00800', '00882')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_LOWER_ABDOMEN = 7;

    #[NameAttribute('Anesthesia for Procedures on the Perineum')]
    #[RangeAttribute('00902', '00952')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_PERINEUM = 8;

    #[NameAttribute('Anesthesia for Procedures on the Pelvis (Except Hip)')]
    #[RangeAttribute('01112', '01173')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_PELVIS = 9;

    #[NameAttribute('Anesthesia for Procedures on the Upper Leg (Except Knee)')]
    #[RangeAttribute('01200', '01274')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_LEG = 10;

    #[NameAttribute('Anesthesia for Procedures on the Knee and Popliteal Area')]
    #[RangeAttribute('01320', '01444')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_KNEE_AND_POPITEAL_AREA = 11;

    #[NameAttribute('Anesthesia for Procedures on the Lower Leg (Below Knee)')]
    #[RangeAttribute('01462', '01522')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_LOWER_LEG = 12;

    #[NameAttribute('Anesthesia for Procedures on the Shoulder and Axilla')]
    #[RangeAttribute('01610', '01680')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_SHOULDER_AND_AXILLA = 13;

    #[NameAttribute('Anesthesia for Procedures on the Upper Arm and Elbow')]
    #[RangeAttribute('01710', '01782')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_ARM_AND_ELBOW = 14;

    #[NameAttribute('Anesthesia for Procedures on the Forearm, Wrist, and Hand')]
    #[RangeAttribute('01810', '01860')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_FOREARM_WRIST_AND_HAND = 15;

    #[NameAttribute('Anesthesia for Radiological Procedures')]
    #[RangeAttribute('01916', '01942')]
    #[PublicAttribute(true)]
    case RADIOLOGICAL_PROCEDURES = 16;

    #[NameAttribute('Anesthesia for Burn Excisions or Debridement Procedures')]
    #[RangeAttribute('01951', '01953')]
    #[PublicAttribute(true)]
    case BURN_EXCISIONS_OR_DEBRIDEMENT_PROCEDURES = 17;

    #[NameAttribute('Anesthesia for Obstetric Procedures')]
    #[RangeAttribute('01958', '01969')]
    #[PublicAttribute(true)]
    case OBSTETRIC_PROCEDURES = 18;

    #[NameAttribute('Anesthesia for Other Procedures')]
    #[RangeAttribute('01990', '01999')]
    #[PublicAttribute(true)]
    case OTHER_PROCEDURES = 19;
}
