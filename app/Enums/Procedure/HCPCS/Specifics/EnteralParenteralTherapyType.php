<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum EnteralParenteralTherapyType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Anesthesia for Procedures on the Head
    // Anesthesia for Procedures on the Neck
    // Anesthesia for Procedures on the Thorax (Chest Wall and Shoulder Girdle)
    // Anesthesia for Intrathoracic Procedures
    // Anesthesia for Procedures on the Spine and Spinal Cord
    // Anesthesia for Procedures on the Upper Abdomen
    // Anesthesia for Procedures on the Lower Abdomen
    // Anesthesia for Procedures on the Perineum
    // Anesthesia for Procedures on the Pelvis (Except Hip)
    // Anesthesia for Procedures on the Upper Leg (Except Knee)
    // Anesthesia for Procedures on the Knee and Popliteal Area
    // Anesthesia for Procedures on the Lower Leg (Below Knee)
    // Anesthesia for Procedures on the Shoulder and Axilla
    // Anesthesia for Procedures on the Upper Arm and Elbow
    // Anesthesia for Procedures on the Forearm, Wrist, and Hand
    // Anesthesia for Radiological Procedures
    // Anesthesia for Burn Excisions or Debridement Procedures
    // Anesthesia for Obstetric Procedures
    // Anesthesia for Other Procedures
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
