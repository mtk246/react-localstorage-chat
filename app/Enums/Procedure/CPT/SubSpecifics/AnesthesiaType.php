<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum AnesthesiaType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;

    #[NameAttribute('Anesthesia for Procedures on the Neck')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_NECK = 2;

    #[NameAttribute('Anesthesia for Procedures on the Thorax (Chest Wall and Shoulder Girdle)')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_THORAX = 3;

    #[NameAttribute('Anesthesia for Intrathoracic Procedures')]
    #[PublicAttribute(true)]
    case INTRATHORACIC_PROCEDURES = 4;

    #[NameAttribute('Anesthesia for Procedures on the Spine and Spinal Cord')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_SPINE_AND_SPINAL_CORD = 5;

    #[NameAttribute('Anesthesia for Procedures on the Upper Abdomen')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_ABDOMEN = 6;

    #[NameAttribute('Anesthesia for Procedures on the Lower Abdomen')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_LOWER_ABDOMEN = 7;

    #[NameAttribute('Anesthesia for Procedures on the Perineum')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_PERINEUM = 8;

    #[NameAttribute('Anesthesia for Procedures on the Pelvis (Except Hip)')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_PELVIS = 9;

    #[NameAttribute('Anesthesia for Procedures on the Upper Leg (Except Knee)')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_LEG = 10;

    #[NameAttribute('Anesthesia for Procedures on the Knee and Popliteal Area')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_KNEE_AND_POPITEAL_AREA = 11;

    #[NameAttribute('Anesthesia for Procedures on the Lower Leg (Below Knee)')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_LOWER_LEG = 12;

    #[NameAttribute('Anesthesia for Procedures on the Shoulder and Axilla')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_SHOULDER_AND_AXILLA = 13;

    #[NameAttribute('Anesthesia for Procedures on the Upper Arm and Elbow')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_UPPER_ARM_AND_ELBOW = 14;

    #[NameAttribute('Anesthesia for Procedures on the Forearm, Wrist, and Hand')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_FOREARM_WRIST_AND_HAND = 15;

    #[NameAttribute('Anesthesia for Radiological Procedures')]
    #[PublicAttribute(true)]
    case RADIOLOGICAL_PROCEDURES = 16;

    #[NameAttribute('Anesthesia for Burn Excisions or Debridement Procedures')]
    #[PublicAttribute(true)]
    case BURN_EXCISIONS_OR_DEBRIDEMENT_PROCEDURES = 17;

    #[NameAttribute('Anesthesia for Obstetric Procedures')]
    #[PublicAttribute(true)]
    case OBSTETRIC_PROCEDURES = 18;

    #[NameAttribute('Anesthesia for Other Procedures')]
    #[PublicAttribute(true)]
    case OTHER_PROCEDURES = 19;
}
