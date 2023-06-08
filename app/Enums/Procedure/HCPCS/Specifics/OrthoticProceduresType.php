<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum OrthoticProceduresType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Cervical Orthotics')]
    #[PublicAttribute(true)]
    case CERVICAL_ORTHOTICS = 1;

    #[NameAttribute('Cervical Orthotics Multi-post Collar')]
    #[PublicAttribute(true)]
    case CERVICAL_ORTHOTICS_MULTIP_POST_COLLAR = 2;

    #[NameAttribute('Thoracic Rib Belts')]
    #[PublicAttribute(true)]
    case THORACIC_RIB_BELTS = 3;

    #[NameAttribute('Thoracic-lumbar-sacral (TLSO) Orthotics')]
    #[PublicAttribute(true)]
    case THORACIC_LUMBAR_SACRAL_TLSO_ORTHOTICS = 4;

    #[NameAttribute('Sacral Orthotics')]
    #[PublicAttribute(true)]
    case SACRAL_ORTHOTICS = 5;

    #[NameAttribute('Lumbar Orthotics')]
    #[PublicAttribute(true)]
    case LUMBAR_ORTHOTICS = 6;

    #[NameAttribute('Lumbar-sacral Orthotics')]
    #[PublicAttribute(true)]
    case LUMBAR_SACRAL_ORTHOTICS = 7;

    #[NameAttribute('Lumbar Orthotics Sagittal Control')]
    #[PublicAttribute(true)]
    case LUMBAR_ORTHOTICS_SAGITTAL_CONTROL = 8;

    #[NameAttribute('Lumbar-sacral Orthotics Sagittal Control')]
    #[PublicAttribute(true)]
    case LUMBAR_SACRAL_ORTHOTICS_SAGITTAL_CONTROL = 9;

    #[NameAttribute('Cervical-thoracic-lumbar-sacral Orthotics')]
    #[PublicAttribute(true)]
    case CERVICAL_THORACIC_LUMBAR_SACRAL_ORTHOTICS = 10;

    #[NameAttribute('Cervical Halo Procedures')]
    #[PublicAttribute(true)]
    case CERVICAL_HALO_PROCEDURES = 11;

    #[NameAttribute('Accessories for Spinal Orthotics')]
    #[PublicAttribute(true)]
    case ACCESSORIES_FOR_SPINAL_ORTHOTICS = 12;

    #[NameAttribute('Scoliosis Orthotic Devices')]
    #[PublicAttribute(true)]
    case SCOLIOSIS_ORTHOTIC_DEVICES = 13;

    #[NameAttribute('Low-profile Additions, Thoracic-lumbar-sacral Orthotics')]
    #[PublicAttribute(true)]
    case LOW_PROFILE_ADDITIONS_THORACIC_LUMBAR_SACRAL_ORTHOTICS = 14;

    #[NameAttribute('Other Scoliosis and Spinal Orthotics and Procedures')]
    #[PublicAttribute(true)]
    case OTHER_SCOLIOSIS_AND_SPINAL_ORTHOTICS_AND_PROCEDURES = 15;

    #[NameAttribute('Hip Orthotics')]
    #[PublicAttribute(true)]
    case HIP_ORTHOTICS = 16;

    #[NameAttribute('Legg Perthes Orthotics')]
    #[PublicAttribute(true)]
    case LEGG_PERTHES_ORTHOTICS = 17;

    #[NameAttribute('Knee Orthotics')]
    #[PublicAttribute(true)]
    case KNEE_ORTHOTICS = 18;

    #[NameAttribute('Ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case ANKLE_FOOT_ORTHOTICS = 19;

    #[NameAttribute('Knee-ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case KNEE_ANKLE_FOOT_ORTHOTICS = 20;

    #[NameAttribute('Hip-knee-ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case HIP_KNEE_ANKLE_FOOT_ORTHOTICS = 21;

    #[NameAttribute('Ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case ANKLE_FOOT_ORTHOTICS_2 = 22;

    #[NameAttribute('Knee-ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case KNEE_ANKLE_FOOT_ORTHOTICS_2 = 23;

    #[NameAttribute('Hip-knee-ankle-foot Orthotics')]
    #[PublicAttribute(true)]
    case HIP_KNEE_ANKLE_FOOT_ORTHOTICS_2 = 24;

    #[NameAttribute('Additions, Lower Extremity, Fracture Orthotics')]
    #[PublicAttribute(true)]
    case ADDITIONS_LOWER_EXTREMITY_FRACTURE_ORTHOTICS = 25;

    #[NameAttribute('Additions, Lower Extremity Orthotics')]
    #[PublicAttribute(true)]
    case ADDITIONS_LOWER_EXTREMITY_ORTHOTICS = 26;

    #[NameAttribute('Orthotic Additions to Knee Joints')]
    #[PublicAttribute(true)]
    case ORTHOTIC_ADDITIONS_TO_KNEE_JOINTS = 27;

    #[NameAttribute('Additions, Weight-bearing, Lower Extremities')]
    #[PublicAttribute(true)]
    case ADDITIONS_WEIGHT_BEARING_LOWER_EXTREMITIES = 28;

    #[NameAttribute('Additions, Pelvic and/or Thoracic Control, Lower Extremities')]
    #[PublicAttribute(true)]
    case ADDITIONS_PELVIC_AND_OR_THORACIC_CONTROL_LOWER_EXTREMITIES = 29;

    #[NameAttribute('Other Lower Extremity Additions')]
    #[PublicAttribute(true)]
    case OTHER_LOWER_EXTREMITY_ADDITIONS = 30;

    #[NameAttribute('Foot Inserts, Removable')]
    #[PublicAttribute(true)]
    case FOOT_INSERTS_REMOVABLE = 31;

    #[NameAttribute('Foot Arch Supports')]
    #[PublicAttribute(true)]
    case FOOT_ARCH_SUPPORTS = 32;

    #[NameAttribute('Repositioning Foot Orthotics')]
    #[PublicAttribute(true)]
    case REPOSITIONING_FOOT_ORTHOTICS = 33;

    #[NameAttribute('Orthopedic Shoes')]
    #[PublicAttribute(true)]
    case ORTHOPEDIC_SHOES = 34;

    #[NameAttribute('Surgical Boots')]
    #[PublicAttribute(true)]
    case SURGICAL_BOOTS = 35;

    #[NameAttribute('Benesch Boots')]
    #[PublicAttribute(true)]
    case BENESCH_BOOTS = 36;

    #[NameAttribute('Other Orthopedic Footwear')]
    #[PublicAttribute(true)]
    case OTHER_ORTHOPEDIC_FOOTWEAR = 37;

    #[NameAttribute('Shoe Lifts')]
    #[PublicAttribute(true)]
    case SHOE_LIFTS = 38;

    #[NameAttribute('Shoe Wedges')]
    #[PublicAttribute(true)]
    case SHOE_WEDGES = 39;

    #[NameAttribute('Shoe Heels')]
    #[PublicAttribute(true)]
    case SHOE_HEELS = 40;

    #[NameAttribute('Other Orthopedic Shoe Additions')]
    #[PublicAttribute(true)]
    case OTHER_ORTHOPEDIC_SHOE_ADDITIONS = 41;

    #[NameAttribute('Orthosis Transfers')]
    #[PublicAttribute(true)]
    case ORTHOSIS_TRANSFERS = 42;

    #[NameAttribute('Shoulder Orthotics')]
    #[PublicAttribute(true)]
    case SHOULDER_ORTHOTICS = 43;

    #[NameAttribute('Elbow Orthotics')]
    #[PublicAttribute(true)]
    case ELBOW_ORTHOTICS = 44;

    #[NameAttribute('Elbow-wrist-hand Orthotics')]
    #[PublicAttribute(true)]
    case ELBOW_WRIST_HAND_ORTHOTICS = 45;

    #[NameAttribute('Wrist-hand-finger Orthotics')]
    #[PublicAttribute(true)]
    case WRIST_HAND_FINGER_ORTHOTICS = 46;

    #[NameAttribute('Wrist-hand Orthotics')]
    #[PublicAttribute(true)]
    case WRIST_HAND_ORTHOTICS = 47;

    #[NameAttribute('Additional Miscellaneous Orthotics, Upper Extremities')]
    #[PublicAttribute(true)]
    case ADDITIONAL_MISCELLANEOUS_ORTHOTICS_UPPER_EXTREMITIES = 48;

    #[NameAttribute('Shoulder-elbow-wrist-hand Orthotics')]
    #[PublicAttribute(true)]
    case SHOULDER_ELBOW_WRIST_HAND_ORTHOTICS = 49;

    #[NameAttribute('Shoulder-elbow-wrist-hand-finger Orthotics')]
    #[PublicAttribute(true)]
    case SHOULDER_ELBOW_WRIST_HAND_FINGER_ORTHOTICS = 50;

    #[NameAttribute('Fracture, Addition, and Unspecified Orthotics, Upper Extremities')]
    #[PublicAttribute(true)]
    case FRACTURE_ADDITION_AND_UNSPECIFIED_ORTHOTICS_UPPER_EXTREMITIES = 51;

    #[NameAttribute('Orthotic Replacement Parts or Repair')]
    #[PublicAttribute(true)]
    case ORTHOTIC_REPLACEMENT_PARTS_OR_REPAIR = 52;

    #[NameAttribute('Other Lower Extremity Orthotics')]
    #[PublicAttribute(true)]
    case OTHER_LOWER_EXTREMITY_ORTHOTICS = 53;
}
