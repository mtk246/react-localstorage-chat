<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ProstheticProcedureType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Partial Foot Prosthetics')]
    #[PublicAttribute(true)]
    case PARTAIL_FOOT_PROSTHETICS = 1;

    #[NameAttribute('Ankle Prosthetics')]
    #[PublicAttribute(true)]
    case ANKLE_PROSTHETICS = 2;

    #[NameAttribute('Below the Knee Prosthetics')]
    #[PublicAttribute(true)]
    case BELOW_THE_KNEE_PROSTHETICS = 3;

    #[NameAttribute('Knee Disarticulation Prosthetics')]
    #[PublicAttribute(true)]
    case KNEE_DISARTICULATION_PROSTHETICS = 4;

    #[NameAttribute('Above the Knee Prosthetics')]
    #[PublicAttribute(true)]
    case ABOVE_THE_KNEE_PROSTHETICS = 5;

    #[NameAttribute('Hip Disarticulation Prosthetics')]
    #[PublicAttribute(true)]
    case HIP_DISARTICULATION_PROSTHETICS = 6;

    #[NameAttribute('Endoskeletal Prosthetics, Lower Limbs')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_PROSTHETICS_LOWER_LIMBS = 7;

    #[NameAttribute('Prosthetic Fitting, Immediate Postsurgical or Early, Lower Limbs')]
    #[PublicAttribute(true)]
    case PROSTHETIC_FITTING_IMMEDIATE_POSTSURGICAL_OR_EARLY_LOWER_LIMBS = 8;

    #[NameAttribute('Supply, Initial Prosthesis')]
    #[PublicAttribute(true)]
    case SUPPLY_INITIAL_PROSTHESIS = 9;

    #[NameAttribute('Supply, Preparatory Prosthesis')]
    #[PublicAttribute(true)]
    case SUPPLY_PREPARATORY_PROSTHESIS = 10;

    #[NameAttribute('Endoskeletal Prosthetic Additions, Lower Extremities')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_PROSTHETIC_ADDITIONS_LOWER_EXTREMITIES = 11;

    #[NameAttribute('Test Socket Prosthetic Additions, Lower Extremities')]
    #[PublicAttribute(true)]
    case TEST_SOCKET_PROSTHETIC_ADDITIONS_LOWER_EXTREMITIES = 12;

    #[NameAttribute('Various Prosthetic Sockets')]
    #[PublicAttribute(true)]
    case VARIOUS_PROSTHETIC_SOCKETS = 13;

    #[NameAttribute('Socket Insert, Suspensions, and Other Prosthetic Additions')]
    #[PublicAttribute(true)]
    case SOCKET_INSERT_SUSPENSIONS_AND_OTHER_PROSTHETIC_ADDITIONS = 14;

    #[NameAttribute('Replacement Sockets')]
    #[PublicAttribute(true)]
    case REPLACEMENT_SOCKETS = 15;

    #[NameAttribute('Custom-shaped Protective Covers')]
    #[PublicAttribute(true)]
    case CUSTOM_SHAPED_PROTECTIVE_COVERS = 16;

    #[NameAttribute('Exoskeletal Knee-shin System Additions')]
    #[PublicAttribute(true)]
    case EXOSKELETAL_KNEE_SHIN_SYSTEM_ADDITIONS = 17;

    #[NameAttribute('Vacuum Pumps, Lower Limb Prosthetic Additions')]
    #[PublicAttribute(true)]
    case VACUUM_PUMPS_LOWER_LIMB_PROSTHETIC_ADDITIONS = 18;

    #[NameAttribute('Other Exoskeletal Additions')]
    #[PublicAttribute(true)]
    case OTHER_EXOSKELETAL_ADDITIONS = 19;

    #[NameAttribute('Endoskeletal Knee or Hip System Additions')]
    #[PublicAttribute(true)]
    case ENDOSKELETAL_KNEE_OR_HIP_SYSTEM_ADDITIONS = 20;

    #[NameAttribute('Ankle and/or Foot Prosthetics and Additions')]
    #[PublicAttribute(true)]
    case ANKLE_AND_OR_FOOT_PROSTHETICS_AND_ADDITIONS = 21;

    #[NameAttribute('Partial Hand Prosthetics')]
    #[PublicAttribute(true)]
    case PARTIAL_HAND_PROSTHETICS = 22;

    #[NameAttribute('Wrist Disarticulation, Hand Prosthetics')]
    #[PublicAttribute(true)]
    case WRIST_DISARTICULATION_HAND_PROSTHETICS = 23;

    #[NameAttribute('Below Elbow, Forearm and Hand Prosthetics')]
    #[PublicAttribute(true)]
    case BELOW_ELBOW_FOREARM_AND_HAND_PROSTHETICS = 24;

    #[NameAttribute('Elbow Disarticulation, Forearm and Hand Prosthetics')]
    #[PublicAttribute(true)]
    case ELBOW_DISARTICULATION_FOREARM_AND_HAND_PROSTHETICS = 25;

    #[NameAttribute('Above Elbow, Forearm and Hand Prosthetics')]
    #[PublicAttribute(true)]
    case ABOVE_ELBOW_FOREARM_AND_HAND_PROSTHETICS = 26;

    #[NameAttribute('Shoulder Disarticulation, Arm and Hand Prosthetics')]
    #[PublicAttribute(true)]
    case SHOULDER_DISARTICULATION_ARM_AND_HAND_PROSTHETICS = 27;

    #[NameAttribute('Interscapular Thoracic, Arm, and Hand Prosthetics')]
    #[PublicAttribute(true)]
    case INTERSCAPULAR_THORACIC_ARM_AND_HAND_PROSTHETICS = 28;

    #[NameAttribute('Prosthetic Fitting, Immediate Postsurgical or Early, Upper Limbs')]
    #[PublicAttribute(true)]
    case PROSTHETIC_FITTING_IMMEDIATE_POSTSURGICAL_OR_EARLY_UPPER_LIMBS = 29;

    #[NameAttribute('Molded Socket Endoskeletal Prosthetic System, Upper Limbs')]
    #[PublicAttribute(true)]
    case MOLDED_SOCKET_ENDOSKELETAL_PROSTHETIC_SYSTEM_UPPER_LIMBS = 30;

    #[NameAttribute('Preparatory Prosthetic, Upper Limbs')]
    #[PublicAttribute(true)]
    case PREPARATORY_PROSTHETIC_UPPER_LIMBS = 31;

    #[NameAttribute('Upper Extremity Prosthetic Additions')]
    #[PublicAttribute(true)]
    case UPPER_EXTREMITY_PROSTHETIC_ADDITIONS = 32;

    #[NameAttribute('Terminal Devices and Additions')]
    #[PublicAttribute(true)]
    case TERMINAL_DEVICES_AND_ADDITIONS = 33;

    #[NameAttribute('Replacement Sockets, Upper Limbs')]
    #[PublicAttribute(true)]
    case REPLACEMENT_SOCKETS_UPPER_LIMBS = 34;

    #[NameAttribute('Hand Restoration Prosthetics and Additions')]
    #[PublicAttribute(true)]
    case HAND_RESTORATION_PROSTHETICS_AND_ADDITIONS = 35;

    #[NameAttribute('External Power Upper Limb Prosthetics')]
    #[PublicAttribute(true)]
    case EXTERNAL_POWER_UPPER_LIMB_PROSTHETICS = 36;

    #[NameAttribute('Electric Hand or Hook and Additions')]
    #[PublicAttribute(true)]
    case ELECTRIC_HAND_OR_HOOK_AND_ADDITIONS = 37;

    #[NameAttribute('Electronic Elbow and Additions')]
    #[PublicAttribute(true)]
    case ELECTRONIC_ELBOW_AND_ADDITIONS = 38;

    #[NameAttribute('Batteries and Accessories')]
    #[PublicAttribute(true)]
    case BATTERIES_AND_ACCESSORIES = 39;

    #[NameAttribute('Additions for Upper Extremity Prosthetics')]
    #[PublicAttribute(true)]
    case ADDITIONS_FOR_UPPER_EXTREMITY_PROSTHETICS = 40;

    #[NameAttribute('Upper Extremity Prosthetics, Not Otherwise Specified (NOS)')]
    #[PublicAttribute(true)]
    case UPPER_EXTREMITY_PROSTHETICS_NOT_OTHERWISE_SPECIFIED_NOS = 41;

    #[NameAttribute('Prosthetic Repair')]
    #[PublicAttribute(true)]
    case PROSTHETIC_REPAIR = 42;

    #[NameAttribute('Prosthetic Donning Sleeve')]
    #[PublicAttribute(true)]
    case PROSTHETIC_DONNING_SLEEVE = 43;

    #[NameAttribute('Gasket or Seal with Prosthetic')]
    #[PublicAttribute(true)]
    case GASKET_OR_SEAL_WITH_PROSTHETIC = 44;

    #[NameAttribute('Penile Prosthetics')]
    #[PublicAttribute(true)]
    case PENILE_PROSTHETICS = 45;

    #[NameAttribute('Breast Prosthetics and Accessories')]
    #[PublicAttribute(true)]
    case BREAST_PROSTHETICS_AND_ACCESSORIES = 46;

    #[NameAttribute('Facial and External Ear Prosthetics')]
    #[PublicAttribute(true)]
    case FACIAL_AND_EXTERNAL_EAR_PROSTHETICS = 47;

    #[NameAttribute('Hernia Trusses')]
    #[PublicAttribute(true)]
    case HERNIA_TRUSSES = 48;

    #[NameAttribute('Prosthetic Sheaths, Socks, and Shrinkers')]
    #[PublicAttribute(true)]
    case PROSTHETIC_SHEATHS_SOCKS_AND_SHRINKERS = 49;

    #[NameAttribute('Unlisted Prosthetic Procedures')]
    #[PublicAttribute(true)]
    case UNLISTED_PROSTHETIC_PROCEDURES = 50;

    #[NameAttribute('Voice Prosthetics and Accessories')]
    #[PublicAttribute(true)]
    case VOICE_PROSTHETICS_AND_ACCESSORIES = 51;

    #[NameAttribute('Prosthetic Breast Implant')]
    #[PublicAttribute(true)]
    case PROSTHETIC_BREAST_IMPLANT = 52;

    #[NameAttribute('Bulking Agents')]
    #[PublicAttribute(true)]
    case BULKING_AGENTS = 53;

    #[NameAttribute('Implantable Eye and Ear Prosthetics and Accessories')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_EYE_AND_EAR_PROSTHETICS_AND_ACCESSORIES = 54;

    #[NameAttribute('Implantable Hand and Feet Prosthetics')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_HAND_AND_FEET_PROSTHETICS = 55;

    #[NameAttribute('Vascular Implants')]
    #[PublicAttribute(true)]
    case VASCULAR_IMPLANTS = 56;

    #[NameAttribute('Implantable Neurostimulators and Components')]
    #[PublicAttribute(true)]
    case IMPLANTABLE_NEUROSTIMULATORS_AND_COMPONENTS = 57;

    #[NameAttribute('Miscellaneous Orthotic and Prosthetic Services and Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_ORTHOTIC_AND_PROSTHETIC_SERVICES_AND_SUPPLIES = 58;
}
