<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum OutpatientPPSType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Assorted Devices and Supplies
    // Brachytherapy Sources
    // Cardioverter-defibrillators
    // Catheters for Multiple Applications
    // Assorted Devices, Implants, and Systems
    // Brachytherapy Sources
    // Assorted Cardiovascular and Genitourinary Devices
    // Brachytherapy Sources
    // Skin Substitute Graft Application
    // Miscellaneous Surgical Procedures
    // Mental Health Evaluation and Management Services
    // Magnetic Resonance Angiography, Trunk and Lower Extremities
    // Transesophageal/Transthoracic Echocardiography
    // Magnetic Resonance Angiography, Spine and Upper Extremities
    // Breast MRI - Computer Aided Detection
    // Miscellaneous Drugs, Biologicals, and Supplies
    // Fresh Frozen Plasma-Covid-19
    // Percutaneous Transcatheter/Transluminal Coronary Procedures
    // Other Therapeutic Services and Supplies
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
