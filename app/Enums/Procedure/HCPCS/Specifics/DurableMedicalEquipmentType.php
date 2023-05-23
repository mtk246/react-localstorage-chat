<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum DurableMedicalEquipmentType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Walking Aids and Attachments
    // Sitz Bath/Equipment
    // Commode Chair and Supplies
    // Pressure Mattresses, Pads, and Other Supplies
    // Heat, Cold, and Light Therapies
    // Bathing Supplies
    // Hospital Beds and Associated Supplies
    // Oxygen Delivery Systems and Related Supplies
    // Intermittent Positive Pressure Breathing Devices
    // Humidifiers and Nebulizers with Related Equipment
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;

    // Breast Pumps
    // Other Breathing Aids
    // Monitoring Equipment
    // Patient Lifts and Support Systems
    // Pneumatic Compressors and Appliances
    // ULTRAVIOLET LIGHT THERAPY SYSTEMS
    // Safety Devices
    // Stimulation Devices
    // Infusion Pumps and Supplies
    // Traction and Other Orthopedic Devices
    // Wheelchair Accessories
    // Transport Chairs
    // Fully Reclining Wheelchairs
    // Hemi-Wheelchairs
    // Lightweight, High-strength Wheelchairs
    // Heavy Duty, Wide Wheelchairs
    // Semi-reclining Wheelchairs
    // Standard Wheelchairs
    // Amputee Wheelchairs
    // Other Wheelchairs and Accessories
    // Pediatric Wheelchairs
    // Lightweight Wheelchairs
    // Heavy Duty and Special Wheelchairs
    // Whirlpool Baths
    // Accessories for Oxygen Delivery Devices
    // Dialysis Systems and Accessories
    // Jaw Motion Rehabilitation Systems
    // Extension/Flexion Rehabilitation Devices
    // Communication Boards
    // Miscellaneous Pumps and Monitors
    // Virtual Reality Cognitive Behavioral Therapy Device (CBT)
    // Manual Wheelchair Accessories
    // Power Wheelchair Accessories
    // Wound Therapy Pumps
    // Speech Generating Devices, Software, and Accessories
    // Wheelchair Seat and Back Cushions
    // Wheelchair Mobile Arm Supports
    // Pediatric Gait Trainers
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
