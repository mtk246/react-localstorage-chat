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

    // Cervical Orthotics
    // Cervical Orthotics Multi-post Collar
    // Thoracic Rib Belts
    // Thoracic-lumbar-sacral (TLSO) Orthotics
    // Sacral Orthotics
    // Lumbar Orthotics
    // Lumbar-sacral Orthotics
    // Lumbar Orthotics Sagittal Control
    // Lumbar-sacral Orthotics Sagittal Control
    // Cervical-thoracic-lumbar-sacral Orthotics
    // Cervical Halo Procedures
    // Accessories for Spinal Orthotics
    // Scoliosis Orthotic Devices
    // Low-profile Additions, Thoracic-lumbar-sacral Orthotics
    // Other Scoliosis and Spinal Orthotics and Procedures
    // Hip Orthotics
    // Legg Perthes Orthotics
    // Knee Orthotics
    // Ankle-foot Orthotics
    // Knee-ankle-foot Orthotics
    // Hip-knee-ankle-foot Orthotics
    // Ankle-foot Orthotics
    // Knee-ankle-foot Orthotics
    // Additions, Lower Extremity, Fracture Orthotics
    // Additions, Lower Extremity Orthotics
    // Orthotic Additions to Knee Joints
    // Additions, Weight-bearing, Lower Extremities
    // Additions, Pelvic and/or Thoracic Control, Lower Extremities
    // Other Lower Extremity Additions
    // Foot Inserts, Removable
    // Foot Arch Supports
    // Repositioning Foot Orthotics
    // Orthopedic Shoes
    // Surgical Boots
    // Benesch Boots
    // Other Orthopedic Footwear
    // Shoe Lifts
    // Shoe Wedges
    // Shoe Heels
    // Other Orthopedic Shoe Additions
    // Orthosis Transfers
    // Shoulder Orthotics
    // Elbow Orthotics
    // Elbow-wrist-hand Orthotics
    // Wrist-hand-finger Orthotics
    // Wrist-hand Orthotics
    // Additional Miscellaneous Orthotics, Upper Extremities
    // Shoulder-elbow-wrist-hand Orthotics
    // Shoulder-elbow-wrist-hand-finger Orthotics
    // Fracture, Addition, and Unspecified Orthotics, Upper Extremities
    // Orthotic Replacement Parts or Repair
    // Other Lower Extremity Orthotics
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
