<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum OutpatientPPSType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Assorted Devices and Supplies')]
    #[RangeAttribute('C1713', 'C1715')]
    #[PublicAttribute(true)]
    case ASSOTED_DEVICES_SUPPLIES = 1;

    #[NameAttribute('Brachytherapy Sources')]
    #[RangeAttribute('C1716', 'C1719')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES = 2;

    #[NameAttribute('Cardioverter-defibrillators')]
    #[RangeAttribute('C1721', 'C1722')]
    #[PublicAttribute(true)]
    case CARDIOVERTER_DEFIBRILLATORS = 3;

    #[NameAttribute('Catheters for Multiple Applications')]
    #[RangeAttribute('C1724', 'C1759')]
    #[PublicAttribute(true)]
    case CATHETERS_FOR_MULTIPLE_APPLICATIONS = 4;

    #[NameAttribute('Assorted Devices, Implants, and Systems')]
    #[RangeAttribute('C1760', 'C2615')]
    #[PublicAttribute(true)]
    case ASSORTED_DEVICES_IMPLANTS_SYSTEMS = 5;

    #[NameAttribute('Brachytherapy Sources')]
    #[RangeAttribute('C2616', 'C2616')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES_I = 6;

    #[NameAttribute('Assorted Cardiovascular and Genitourinary Devices')]
    #[RangeAttribute('C2617', 'C2631')]
    #[PublicAttribute(true)]
    case ASSORTED_CARDIOVASCULAR_GENITOURINARY_DEVICES = 7;

    #[NameAttribute('Brachytherapy Sources')]
    #[RangeAttribute('C2634', 'C2699')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES_II = 8;

    #[NameAttribute('Skin Substitute Graft Application')]
    #[RangeAttribute('C5271', 'C5278')]
    #[PublicAttribute(true)]
    case SKIN_SUBSTITUTE_GRAFT_APPLICATION = 9;

    #[NameAttribute('Miscellaneous Surgical Procedures')]
    #[RangeAttribute('C7500', 'C7555')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SURGICAL_PROCEDURES = 10;

    #[NameAttribute('Mental Health Evaluation and Management Services')]
    #[RangeAttribute('C7900', 'C7902')]
    #[PublicAttribute(true)]
    case MENTAL_HEALTH_EVALUATION_AND_MANAGEMENT_SERVICES = 11;

    #[NameAttribute('Magnetic Resonance Angiography, Trunk and Lower Extremities')]
    #[RangeAttribute('C8900', 'C8920')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_ANGIOGRAPHY_TRUNK_AND_LOWER_EXTREMITIES = 12;

    #[NameAttribute('Transesophageal/Transthoracic Echocardiography')]
    #[RangeAttribute('C8921', 'C8930')]
    #[PublicAttribute(true)]
    case TRANSESOPHAGEAL_TRANSTHORACIC_ECHOCARDIOGRAPHY = 13;

    #[NameAttribute('Magnetic Resonance Angiography, Spine and Upper Extremities')]
    #[RangeAttribute('C8931', 'C8936')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_ANGIOGRAPHY_SPINE_AND_UPPER_EXTREMITIES = 14;

    #[NameAttribute('Breast MRI - Computer Aided Detection')]
    #[RangeAttribute('C8937', 'C8937')]
    #[PublicAttribute(true)]
    case BREAST_MRI_COMPUTER_AIDED_DETECTION = 15;

    #[NameAttribute('Miscellaneous Drugs, Biologicals, and Supplies')]
    #[RangeAttribute('C8957', 'C9488')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS_BIOLOGICALS_AND_SUPPLIES = 16;

    #[NameAttribute('Fresh Frozen Plasma-Covid-19')]
    #[RangeAttribute('C9507', 'C9507')]
    #[PublicAttribute(true)]
    case FRESH_FROZEN_PLASMA_COVID_19 = 17;

    #[NameAttribute('Percutaneous Transcatheter/Transluminal Coronary Procedures')]
    #[RangeAttribute('C9600', 'C9608')]
    #[PublicAttribute(true)]
    case PERCUTANEOUS_TRANSCATHETER = 18;

    #[NameAttribute('Other Therapeutic Services and Supplies')]
    #[RangeAttribute('C9725', 'C9899')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES_AND_SUPPLIES = 19;
}
