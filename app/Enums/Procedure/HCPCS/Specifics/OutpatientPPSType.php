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

    #[NameAttribute('Assorted Devices and Supplies')]
    #[PublicAttribute(true)]
    case ASSOTED_DEVICES_SUPPLIES = 1;

    #[NameAttribute('Brachytherapy Sources')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES = 2;

    #[NameAttribute('Cardioverter-defibrillators')]
    #[PublicAttribute(true)]
    case CARDIOVERTER_DEFIBRILLATORS = 3;

    #[NameAttribute('Catheters for Multiple Applications')]
    #[PublicAttribute(true)]
    case CATHETERS_FOR_MULTIPLE_APPLICATIONS = 4;

    #[NameAttribute('Assorted Devices, Implants, and Systems')]
    #[PublicAttribute(true)]
    case ASSORTED_DEVICES_IMPLANTS_SYSTEMS = 5;

    #[NameAttribute('Brachytherapy Sources')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES_I = 6;

    #[NameAttribute('Assorted Cardiovascular and Genitourinary Devices')]
    #[PublicAttribute(true)]
    case ASSORTED_CARDIOVASCULAR_GENITOURINARY_DEVICES = 7;

    #[NameAttribute('Brachytherapy Sources')]
    #[PublicAttribute(true)]
    case BRACHYTHERAPY_SOURCES_II = 8;

    #[NameAttribute('Skin Substitute Graft Application')]
    #[PublicAttribute(true)]
    case SKIN_SUBSTITUTE_GRAFT_APPLICATION = 9;

    #[NameAttribute('Miscellaneous Surgical Procedures')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SURGICAL_PROCEDURES = 10;

    #[NameAttribute('Mental Health Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case MENTAL_HEALTH_EVALUATION_AND_MANAGEMENT_SERVICES = 11;

    #[NameAttribute('Magnetic Resonance Angiography, Trunk and Lower Extremities')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_ANGIOGRAPHY_TRUNK_AND_LOWER_EXTREMITIES = 12;

    #[NameAttribute('Transesophageal/Transthoracic Echocardiography')]
    #[PublicAttribute(true)]
    case TRANSESOPHAGEAL_TRANSTHORACIC_ECHOCARDIOGRAPHY = 13;

    #[NameAttribute('Magnetic Resonance Angiography, Spine and Upper Extremities')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_ANGIOGRAPHY_SPINE_AND_UPPER_EXTREMITIES = 14;

    #[NameAttribute('Breast MRI - Computer Aided Detection')]
    #[PublicAttribute(true)]
    case BREAST_MRI_COMPUTER_AIDED_DETECTION = 15;

    #[NameAttribute('Miscellaneous Drugs, Biologicals, and Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS_BIOLOGICALS_AND_SUPPLIES = 16;

    #[NameAttribute('Fresh Frozen Plasma-Covid-19')]
    #[PublicAttribute(true)]
    case FRESH_FROZEN_PLASMA_COVID_19 = 17;

    #[NameAttribute('Percutaneous Transcatheter/Transluminal Coronary Procedures')]
    #[PublicAttribute(true)]
    case PERCUTANEOUS_TRANSCATHETER = 18;

    #[NameAttribute('Other Therapeutic Services and Supplies')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES_AND_SUPPLIES = 19;
}
