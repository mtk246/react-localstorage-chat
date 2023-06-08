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

enum ProstheticProcedureType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Partial Foot Prosthetics')]
    #[RangeAttribute('L5000', 'L5020')]
    #[PublicAttribute(true)]
    case PARTAIL_FOOT_PROSTHETICS = 1;

    #[NameAttribute('Ankle Prosthetics')]
    #[RangeAttribute('L5050', 'L5060')]
    #[PublicAttribute(true)]
    case ANKLE_PROSTHETICS = 2;

    #[NameAttribute('Below the Knee Prosthetics')]
    #[RangeAttribute('L5100', 'L5105')]
    #[PublicAttribute(true)]
    case BELOW_THE_KNEE_PROSTHETICS = 3;

    #[NameAttribute('Knee Disarticulation Prosthetics')]
    #[RangeAttribute('L5150', 'L5160')]
    #[PublicAttribute(true)]
    case KNEE_DISARTICULATION_PROSTHETICS = 4;

    #[NameAttribute('Above the Knee Prosthetics')]
    #[RangeAttribute('L5200', 'L5230')]
    #[PublicAttribute(true)]
    case ABOVE_THE_KNEE_PROSTHETICS = 5;

    #[NameAttribute('Hip Disarticulation Prosthetics')]
    #[RangeAttribute('L5250', 'L5270')]
    #[PublicAttribute(true)]
    case HIP_DISARTICULATION_PROSTHETICS = 6;

    #[NameAttribute('Endoskeletal Prosthetics, Lower Limbs')]
    #[RangeAttribute('L5280', 'L5341')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_PROSTHETICS_LOWER_LIMBS = 7;

    #[NameAttribute('Prosthetic Fitting, Immediate Postsurgical or Early, Lower Limbs')]
    #[RangeAttribute('L5400', 'L5460')]
    #[PublicAttribute(true)]
    case PROSTHETIC_FITTING_IMMEDIATE_POSTSURGICAL_OR_EARLY_LOWER_LIMBS = 8;

    #[NameAttribute('Supply, Initial Prosthesis')]
    #[RangeAttribute('L5500', 'L5505')]
    #[PublicAttribute(true)]
    case SUPPLY_INITIAL_PROSTHESIS = 9;

    #[NameAttribute('Supply, Preparatory Prosthesis')]
    #[RangeAttribute('L5510', 'L5600')]
    #[PublicAttribute(true)]
    case SUPPLY_PREPARATORY_PROSTHESIS = 10;

    #[NameAttribute('Endoskeletal Prosthetic Additions, Lower Extremities')]
    #[RangeAttribute('L5610', 'L5617')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_PROSTHETIC_ADDITIONS_LOWER_EXTREMITIES = 11;

    #[NameAttribute('Test Socket Prosthetic Additions, Lower Extremities')]
    #[RangeAttribute('L5618', 'L5628')]
    #[PublicAttribute(true)]
    case TEST_SOCKET_PROSTHETIC_ADDITIONS_LOWER_EXTREMITIES = 12;

    #[NameAttribute('Various Prosthetic Sockets')]
    #[RangeAttribute('L5629', 'L5653')]
    #[PublicAttribute(true)]
    case VARIOUS_PROSTHETIC_SOCKETS = 13;

    #[NameAttribute('Socket Insert, Suspensions, and Other Prosthetic Additions')]
    #[RangeAttribute('L5654', 'L5699')]
    #[PublicAttribute(true)]
    case SOCKET_INSERT_SUSPENSIONS_AND_OTHER_PROSTHETIC_ADDITIONS = 14;

    #[NameAttribute('Replacement Sockets')]
    #[RangeAttribute('L5700', 'L5703')]
    #[PublicAttribute(true)]
    case REPLACEMENT_SOCKETS = 15;

    #[NameAttribute('Custom-shaped Protective Covers')]
    #[RangeAttribute('L5704', 'L5707')]
    #[PublicAttribute(true)]
    case CUSTOM_SHAPED_PROTECTIVE_COVERS = 16;

    #[NameAttribute('Exoskeletal Knee-shin System Additions')]
    #[RangeAttribute('L5710', 'L5780')]
    #[PublicAttribute(true)]
    case EXOSKELETAL_KNEE_SHIN_SYSTEM_ADDITIONS = 17;

    #[NameAttribute('Vacuum Pumps, Lower Limb Prosthetic Additions')]
    #[RangeAttribute('L5781', 'L5782')]
    #[PublicAttribute(true)]
    case VACUUM_PUMPS_LOWER_LIMB_PROSTHETIC_ADDITIONS = 18;

    #[NameAttribute('Other Exoskeletal Additions')]
    #[RangeAttribute('L5785', 'L5795')]
    #[PublicAttribute(true)]
    case OTHER_EXOSKELETAL_ADDITIONS = 19;

    #[NameAttribute('Endoskeletal Knee or Hip System Additions')]
    #[RangeAttribute('L5810', 'L5966')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_KNEE_OR_HIP_SYSTEM_ADDITIONS = 20;

    #[NameAttribute('Ankle and/or Foot Prosthetics and Additions')]
    #[RangeAttribute('L5968', 'L5999')]
    #[PublicAttribute(true)]
    case ANKLE_AND_OR_FOOT_PROSTHETICS_AND_ADDITIONS = 21;

    #[NameAttribute('Partial Hand Prosthetics')]
    #[RangeAttribute('L6000', 'L6026')]
    #[PublicAttribute(true)]
    case PARTIAL_HAND_PROSTHETICS = 22;

    #[NameAttribute('Wrist Disarticulation, Hand Prosthetics')]
    #[RangeAttribute('L6050', 'L6055')]
    #[PublicAttribute(true)]
    case WRIST_DISARTICULATION_HAND_PROSTHETICS = 23;

    #[NameAttribute('Below Elbow, Forearm and Hand Prosthetics')]
    #[RangeAttribute('L6100', 'L6130')]
    #[PublicAttribute(true)]
    case BELOW_ELBOW_FOREARM_AND_HAND_PROSTHETICS = 24;

    #[NameAttribute('Elbow Disarticulation, Forearm and Hand Prosthetics')]
    #[RangeAttribute('L6200', 'L6205')]
    #[PublicAttribute(true)]
    case ELBOW_DISARTICULATION_FOREARM_AND_HAND_PROSTHETICS = 25;

    #[NameAttribute('Above Elbow, Forearm and Hand Prosthetics')]
    #[RangeAttribute('L6250', 'L6250')]
    #[PublicAttribute(true)]
    case ABOVE_ELBOW_FOREARM_AND_HAND_PROSTHETICS = 26;

    #[NameAttribute('Shoulder Disarticulation, Arm and Hand Prosthetics')]
    #[RangeAttribute('L6300', 'L6320')]
    #[PublicAttribute(true)]
    case SHOULDER_DISARTICULATION_ARM_AND_HAND_PROSTHETICS = 27;

    #[NameAttribute('Interscapular Thoracic, Arm, and Hand Prosthetics')]
    #[RangeAttribute('L6350', 'L6370')]
    #[PublicAttribute(true)]
    case INTERSCAPULAR_THORACIC_ARM_AND_HAND_PROSTHETICS = 28;

    #[NameAttribute('Prosthetic Fitting, Immediate Postsurgical or Early, Upper Limbs')]
    #[RangeAttribute('L6380', 'L6388')]
    #[PublicAttribute(true)]
    case PROSTHETIC_FITTING_IMMEDIATE_POSTSURGICAL_OR_EARLY_UPPER_LIMBS = 29;

    #[NameAttribute('Molded Socket Endoskeletal Prosthetic System, Upper Limbs')]
    #[RangeAttribute('L6400', 'L6570')]
    #[PublicAttribute(true)]
    case MOLDED_SOCKET_ENDOSKELETAL_PROSTHETIC_SYSTEM_UPPER_LIMBS = 30;

    #[NameAttribute('Preparatory Prosthetic, Upper Limbs')]
    #[RangeAttribute('L6580', 'L6590')]
    #[PublicAttribute(true)]
    case PREPARATORY_PROSTHETIC_UPPER_LIMBS = 31;

    #[NameAttribute('Upper Extremity Prosthetic Additions')]
    #[RangeAttribute('L6600', 'L6698')]
    #[PublicAttribute(true)]
    case UPPER_EXTREMITY_PROSTHETIC_ADDITIONS = 32;

    #[NameAttribute('Terminal Devices and Additions')]
    #[RangeAttribute('L6703', 'L6882')]
    #[PublicAttribute(true)]
    case TERMINAL_DEVICES_AND_ADDITIONS = 33;

    #[NameAttribute('Replacement Sockets, Upper Limbs')]
    #[RangeAttribute('L6883', 'L6885')]
    #[PublicAttribute(true)]
    case REPLACEMENT_SOCKETS_UPPER_LIMBS = 34;

    #[NameAttribute('Hand Restoration Prosthetics and Additions')]
    #[RangeAttribute('L6890', 'L6915')]
    #[PublicAttribute(true)]
    case HAND_RESTORATION_PROSTHETICS_AND_ADDITIONS = 35;

    #[NameAttribute('External Power Upper Limb Prosthetics')]
    #[RangeAttribute('L6920', 'L6975')]
    #[PublicAttribute(true)]
    case EXTERNAL_POWER_UPPER_LIMB_PROSTHETICS = 36;

    #[NameAttribute('Electric Hand or Hook and Additions')]
    #[RangeAttribute('L7007', 'L7045')]
    #[PublicAttribute(true)]
    case ELECTRIC_HAND_OR_HOOK_AND_ADDITIONS = 37;

    #[NameAttribute('Electronic Elbow and Additions')]
    #[RangeAttribute('L7170', 'L7259')]
    #[PublicAttribute(true)]
    case ELECTRONIC_ELBOW_AND_ADDITIONS = 38;

    #[NameAttribute('Batteries and Accessories')]
    #[RangeAttribute('L7360', 'L7368')]
    #[PublicAttribute(true)]
    case BATTERIES_AND_ACCESSORIES = 39;

    #[NameAttribute('Additions for Upper Extremity Prosthetics')]
    #[RangeAttribute('L7400', 'L7405')]
    #[PublicAttribute(true)]
    case ADDITIONS_FOR_UPPER_EXTREMITY_PROSTHETICS = 40;

    #[NameAttribute('Upper Extremity Prosthetics, Not Otherwise Specified (NOS)')]
    #[RangeAttribute('L7499', 'L7499')]
    #[PublicAttribute(true)]
    case UPPER_EXTREMITY_PROSTHETICS_NOT_OTHERWISE_SPECIFIED_NOS = 41;

    #[NameAttribute('Prosthetic Repair')]
    #[RangeAttribute('L7510', 'L7520')]
    #[PublicAttribute(true)]
    case PROSTHETIC_REPAIR = 42;

    #[NameAttribute('Prosthetic Donning Sleeve')]
    #[RangeAttribute('L7600', 'L7600')]
    #[PublicAttribute(true)]
    case PROSTHETIC_DONNING_SLEEVE = 43;

    #[NameAttribute('Gasket or Seal with Prosthetic')]
    #[RangeAttribute('L7700', 'L7700')]
    #[PublicAttribute(true)]
    case GASKET_OR_SEAL_WITH_PROSTHETIC = 44;

    #[NameAttribute('Penile Prosthetics')]
    #[RangeAttribute('L7900', 'L7902')]
    #[PublicAttribute(true)]
    case PENILE_PROSTHETICS = 45;

    #[NameAttribute('Breast Prosthetics and Accessories')]
    #[RangeAttribute('L8000', 'L8039')]
    #[PublicAttribute(true)]
    case BREAST_PROSTHETICS_AND_ACCESSORIES = 46;

    #[NameAttribute('Facial and External Ear Prosthetics')]
    #[RangeAttribute('L8040', 'L8049')]
    #[PublicAttribute(true)]
    case FACIAL_AND_EXTERNAL_EAR_PROSTHETICS = 47;

    #[NameAttribute('Hernia Trusses')]
    #[RangeAttribute('L8300', 'L8330')]
    #[PublicAttribute(true)]
    case HERNIA_TRUSSES = 48;

    #[NameAttribute('Prosthetic Sheaths, Socks, and Shrinkers')]
    #[RangeAttribute('L8400', 'L8485')]
    #[PublicAttribute(true)]
    case PROSTHETIC_SHEATHS_SOCKS_AND_SHRINKERS = 49;

    #[NameAttribute('Unlisted Prosthetic Procedures')]
    #[RangeAttribute('L8499', 'L8499')]
    #[PublicAttribute(true)]
    case UNLISTED_PROSTHETIC_PROCEDURES = 50;

    #[NameAttribute('Voice Prosthetics and Accessories')]
    #[RangeAttribute('L8500', 'L8515')]
    #[PublicAttribute(true)]
    case VOICE_PROSTHETICS_AND_ACCESSORIES = 51;

    #[NameAttribute('Prosthetic Breast Implant')]
    #[RangeAttribute('L8600', 'L8600')]
    #[PublicAttribute(true)]
    case PROSTHETIC_BREAST_IMPLANT = 52;

    #[NameAttribute('Bulking Agents')]
    #[RangeAttribute('L8603', 'L8607')]
    #[PublicAttribute(true)]
    case BULKING_AGENTS = 53;

    #[NameAttribute('Implantable Eye and Ear Prosthetics and Accessories')]
    #[RangeAttribute('L8608', 'L8629')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_EYE_AND_EAR_PROSTHETICS_AND_ACCESSORIES = 54;

    #[NameAttribute('Implantable Hand and Feet Prosthetics')]
    #[RangeAttribute('L8630', 'L8659')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_HAND_AND_FEET_PROSTHETICS = 55;

    #[NameAttribute('Vascular Implants')]
    #[RangeAttribute('L8670', 'L8670')]
    #[PublicAttribute(true)]
    case VASCULAR_IMPLANTS = 56;

    #[NameAttribute('Implantable Neurostimulators and Components')]
    #[RangeAttribute('L8678', 'L8689')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_NEUROSTIMULATORS_AND_COMPONENTS = 57;

    #[NameAttribute('Miscellaneous Orthotic and Prosthetic Services and Supplies')]
    #[RangeAttribute('L8690', 'L9900')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_ORTHOTIC_AND_PROSTHETIC_SERVICES_AND_SUPPLIES = 58;
}
