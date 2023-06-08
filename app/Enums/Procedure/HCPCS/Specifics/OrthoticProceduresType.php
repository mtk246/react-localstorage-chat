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

enum OrthoticProceduresType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Cervical Orthotics')]
    #[RangeAttribute('L0112', 'L0174')]
    #[PublicAttribute(true)]
    case CERVICAL_ORTHOTICS = 1;

    #[NameAttribute('Cervical Orthotics Multi-post Collar')]
    #[RangeAttribute('L0180', 'L0200')]
    #[PublicAttribute(true)]
    case CERVICAL_ORTHOTICS_MULTIP_POST_COLLAR = 2;

    #[NameAttribute('Thoracic Rib Belts')]
    #[RangeAttribute('L0220', 'L0220')]
    #[PublicAttribute(true)]
    case THORACIC_RIB_BELTS = 3;

    #[NameAttribute('Thoracic-lumbar-sacral (TLSO) Orthotics')]
    #[RangeAttribute('L0450', 'L0492')]
    #[PublicAttribute(true)]
    case THORACIC_LUMBAR_SACRAL_TLSO_ORTHOTICS = 4;

    #[NameAttribute('Sacral Orthotics')]
    #[RangeAttribute('L0621', 'L0624')]
    #[PublicAttribute(true)]
    case SACRAL_ORTHOTICS = 5;

    #[NameAttribute('Lumbar Orthotics')]
    #[RangeAttribute('L0625', 'L0627')]
    #[PublicAttribute(true)]
    case LUMBAR_ORTHOTICS = 6;

    #[NameAttribute('Lumbar-sacral Orthotics')]
    #[RangeAttribute('L0628', 'L0640')]
    #[PublicAttribute(true)]
    case LUMBAR_SACRAL_ORTHOTICS = 7;

    #[NameAttribute('Lumbar Orthotics Sagittal Control')]
    #[RangeAttribute('L0641', 'L0642')]
    #[PublicAttribute(true)]
    case LUMBAR_ORTHOTICS_SAGITTAL_CONTROL = 8;

    #[NameAttribute('Lumbar-sacral Orthotics Sagittal Control')]
    #[RangeAttribute('L0643', 'L0651')]
    #[PublicAttribute(true)]
    case LUMBAR_SACRAL_ORTHOTICS_SAGITTAL_CONTROL = 9;

    #[NameAttribute('Cervical-thoracic-lumbar-sacral Orthotics')]
    #[RangeAttribute('L0700', 'L0710')]
    #[PublicAttribute(true)]
    case CERVICAL_THORACIC_LUMBAR_SACRAL_ORTHOTICS = 10;

    #[NameAttribute('Cervical Halo Procedures')]
    #[RangeAttribute('L0810', 'L0861')]
    #[PublicAttribute(true)]
    case CERVICAL_HALO_PROCEDURES = 11;

    #[NameAttribute('Accessories for Spinal Orthotics')]
    #[RangeAttribute('L0970', 'L0999')]
    #[PublicAttribute(true)]
    case ACCESSORIES_FOR_SPINAL_ORTHOTICS = 12;

    #[NameAttribute('Scoliosis Orthotic Devices')]
    #[RangeAttribute('L1000', 'L1120')]
    #[PublicAttribute(true)]
    case SCOLIOSIS_ORTHOTIC_DEVICES = 13;

    #[NameAttribute('Low-profile Additions, Thoracic-lumbar-sacral Orthotics')]
    #[RangeAttribute('L1200', 'L1290')]
    #[PublicAttribute(true)]
    case LOW_PROFILE_ADDITIONS_THORACIC_LUMBAR_SACRAL_ORTHOTICS = 14;

    #[NameAttribute('Other Scoliosis and Spinal Orthotics and Procedures')]
    #[RangeAttribute('L1300', 'L1499')]
    #[PublicAttribute(true)]
    case OTHER_SCOLIOSIS_AND_SPINAL_ORTHOTICS_AND_PROCEDURES = 15;

    #[NameAttribute('Hip Orthotics')]
    #[RangeAttribute('L1600', 'L1690')]
    #[PublicAttribute(true)]
    case HIP_ORTHOTICS = 16;

    #[NameAttribute('Legg Perthes Orthotics')]
    #[RangeAttribute('L1700', 'L1755')]
    #[PublicAttribute(true)]
    case LEGG_PERTHES_ORTHOTICS = 17;

    #[NameAttribute('Knee Orthotics')]
    #[RangeAttribute('L1810', 'L1860')]
    #[PublicAttribute(true)]
    case KNEE_ORTHOTICS = 18;

    #[NameAttribute('Ankle-foot Orthotics')]
    #[RangeAttribute('L1900', 'L1990')]
    #[PublicAttribute(true)]
    case ANKLE_FOOT_ORTHOTICS = 19;

    #[NameAttribute('Knee-ankle-foot Orthotics')]
    #[RangeAttribute('L2000', 'L2038')]
    #[PublicAttribute(true)]
    case KNEE_ANKLE_FOOT_ORTHOTICS = 20;

    #[NameAttribute('Hip-knee-ankle-foot Orthotics')]
    #[RangeAttribute('L2040', 'L2090')]
    #[PublicAttribute(true)]
    case HIP_KNEE_ANKLE_FOOT_ORTHOTICS = 21;

    #[NameAttribute('Ankle-foot Orthotics')]
    #[RangeAttribute('L2106', 'L2116')]
    #[PublicAttribute(true)]
    case ANKLE_FOOT_ORTHOTICS_2 = 22;

    #[NameAttribute('Knee-ankle-foot Orthotics')]
    #[RangeAttribute('L2126', 'L2136')]
    #[PublicAttribute(true)]
    case KNEE_ANKLE_FOOT_ORTHOTICS_2 = 23;

    #[NameAttribute('Additions, Lower Extremity, Fracture Orthotics')]
    #[RangeAttribute('L2180', 'L2192')]
    #[PublicAttribute(true)]
    case ADDITIONS_LOWER_EXTREMITY_FRACTURE_ORTHOTICS = 25;

    #[NameAttribute('Additions, Lower Extremity Orthotics')]
    #[RangeAttribute('L2200', 'L2397')]
    #[PublicAttribute(true)]
    case ADDITIONS_LOWER_EXTREMITY_ORTHOTICS = 26;

    #[NameAttribute('Orthotic Additions to Knee Joints')]
    #[RangeAttribute('L2405', 'L2492')]
    #[PublicAttribute(true)]
    case ORTHOTIC_ADDITIONS_TO_KNEE_JOINTS = 27;

    #[NameAttribute('Additions, Weight-bearing, Lower Extremities')]
    #[RangeAttribute('L2500', 'L2550')]
    #[PublicAttribute(true)]
    case ADDITIONS_WEIGHT_BEARING_LOWER_EXTREMITIES = 28;

    #[NameAttribute('Additions, Pelvic and/or Thoracic Control, Lower Extremities')]
    #[RangeAttribute('L2570', 'L2680')]
    #[PublicAttribute(true)]
    case ADDITIONS_PELVIC_AND_OR_THORACIC_CONTROL_LOWER_EXTREMITIES = 29;

    #[NameAttribute('Other Lower Extremity Additions')]
    #[RangeAttribute('L2750', 'L2999')]
    #[PublicAttribute(true)]
    case OTHER_LOWER_EXTREMITY_ADDITIONS = 30;

    #[NameAttribute('Foot Inserts, Removable')]
    #[RangeAttribute('L3000', 'L3031')]
    #[PublicAttribute(true)]
    case FOOT_INSERTS_REMOVABLE = 31;

    #[NameAttribute('Foot Arch Supports')]
    #[RangeAttribute('L3040', 'L3090')]
    #[PublicAttribute(true)]
    case FOOT_ARCH_SUPPORTS = 32;

    #[NameAttribute('Repositioning Foot Orthotics')]
    #[RangeAttribute('L3100', 'L3170')]
    #[PublicAttribute(true)]
    case REPOSITIONING_FOOT_ORTHOTICS = 33;

    #[NameAttribute('Orthopedic Shoes')]
    #[RangeAttribute('L3201', 'L3207')]
    #[PublicAttribute(true)]
    case ORTHOPEDIC_SHOES = 34;

    #[NameAttribute('Surgical Boots')]
    #[RangeAttribute('L3208', 'L3211')]
    #[PublicAttribute(true)]
    case SURGICAL_BOOTS = 35;

    #[NameAttribute('Benesch Boots')]
    #[RangeAttribute('L3212', 'L3214')]
    #[PublicAttribute(true)]
    case BENESCH_BOOTS = 36;

    #[NameAttribute('Other Orthopedic Footwear')]
    #[RangeAttribute('L3215', 'L3265')]
    #[PublicAttribute(true)]
    case OTHER_ORTHOPEDIC_FOOTWEAR = 37;

    #[NameAttribute('Shoe Lifts')]
    #[RangeAttribute('L3300', 'L3334')]
    #[PublicAttribute(true)]
    case SHOE_LIFTS = 38;

    #[NameAttribute('Shoe Wedges')]
    #[RangeAttribute('L3340', 'L3420')]
    #[PublicAttribute(true)]
    case SHOE_WEDGES = 39;

    #[NameAttribute('Shoe Heels')]
    #[RangeAttribute('L3430', 'L3485')]
    #[PublicAttribute(true)]
    case SHOE_HEELS = 40;

    #[NameAttribute('Other Orthopedic Shoe Additions')]
    #[RangeAttribute('L3500', 'L3595')]
    #[PublicAttribute(true)]
    case OTHER_ORTHOPEDIC_SHOE_ADDITIONS = 41;

    #[NameAttribute('Orthosis Transfers')]
    #[RangeAttribute('L3600', 'L3649')]
    #[PublicAttribute(true)]
    case ORTHOSIS_TRANSFERS = 42;

    #[NameAttribute('Shoulder Orthotics')]
    #[RangeAttribute('L3650', 'L3678')]
    #[PublicAttribute(true)]
    case SHOULDER_ORTHOTICS = 43;

    #[NameAttribute('Elbow Orthotics')]
    #[RangeAttribute('L3702', 'L3762')]
    #[PublicAttribute(true)]
    case ELBOW_ORTHOTICS = 44;

    #[NameAttribute('Elbow-wrist-hand Orthotics')]
    #[RangeAttribute('L3763', 'L3766')]
    #[PublicAttribute(true)]
    case ELBOW_WRIST_HAND_ORTHOTICS = 45;

    #[NameAttribute('Wrist-hand-finger Orthotics')]
    #[RangeAttribute('L3806', 'L3904')]
    #[PublicAttribute(true)]
    case WRIST_HAND_FINGER_ORTHOTICS = 46;

    #[NameAttribute('Wrist-hand Orthotics')]
    #[RangeAttribute('L3905', 'L3908')]
    #[PublicAttribute(true)]
    case WRIST_HAND_ORTHOTICS = 47;

    #[NameAttribute('Additional Miscellaneous Orthotics, Upper Extremities')]
    #[RangeAttribute('L3912', 'L3956')]
    #[PublicAttribute(true)]
    case ADDITIONAL_MISCELLANEOUS_ORTHOTICS_UPPER_EXTREMITIES = 48;

    #[NameAttribute('Shoulder-elbow-wrist-hand Orthotics')]
    #[RangeAttribute('L3960', 'L3973')]
    #[PublicAttribute(true)]
    case SHOULDER_ELBOW_WRIST_HAND_ORTHOTICS = 49;

    #[NameAttribute('Shoulder-elbow-wrist-hand-finger Orthotics')]
    #[RangeAttribute('L3975', 'L3978')]
    #[PublicAttribute(true)]
    case SHOULDER_ELBOW_WRIST_HAND_FINGER_ORTHOTICS = 50;

    #[NameAttribute('Fracture, Addition, and Unspecified Orthotics, Upper Extremities')]
    #[RangeAttribute('L3980', 'L3999')]
    #[PublicAttribute(true)]
    case FRACTURE_ADDITION_AND_UNSPECIFIED_ORTHOTICS_UPPER_EXTREMITIES = 51;

    #[NameAttribute('Orthotic Replacement Parts or Repair')]
    #[RangeAttribute('L4000', 'L4210')]
    #[PublicAttribute(true)]
    case ORTHOTIC_REPLACEMENT_PARTS_OR_REPAIR = 52;

    #[NameAttribute('Other Lower Extremity Orthotics')]
    #[RangeAttribute('L4350', 'L4631')]
    #[PublicAttribute(true)]
    case OTHER_LOWER_EXTREMITY_ORTHOTICS = 53;
}
