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

    #[NameAttribute('Sitz Bath/Equipment')]
    #[PublicAttribute(true)]
    case SITZ_BATH_EQUIPMENT = 2;

    #[NameAttribute('Commode Chair and Supplies')]
    #[PublicAttribute(true)]
    case COMMODE_CHAIR_SUPPLIES = 3;

    #[NameAttribute('Pressure Mattresses, Pads, and Other Supplies')]
    #[PublicAttribute(true)]
    case PRESSURE_MATTRESSES_PADS_OTHER_SUPPLIES = 4;

    #[NameAttribute('Heat, Cold, and Light Therapies')]
    #[PublicAttribute(true)]
    case HEAT_COLD_LIGHT_THERAPIES = 5;

    #[NameAttribute('Bathing Supplies')]
    #[PublicAttribute(true)]
    case BATHING_SUPPLIES = 6;

    #[NameAttribute('Hospital Beds and Associated Supplies')]
    #[PublicAttribute(true)]
    case HOSPITAL_BEDS_ASSOCIATED_SUPPLIES = 7;

    #[NameAttribute('Oxygen Delivery Systems and Related Supplies')]
    #[PublicAttribute(true)]
    case OXYGEN_DELIVERY_SYSTEMS_RELATED_SUPPLIES = 8;

    #[NameAttribute('Intermittent Positive Pressure Breathing Devices')]
    #[PublicAttribute(true)]
    case INTERMITTENT_POSITIVE_PRESSURE_BREATHING_DEVICES = 9;

    #[NameAttribute('Humidifiers and Nebulizers with Related Equipment')]
    #[PublicAttribute(true)]
    case HUMIDIFIERS_NEBULIZERS_RELATED_EQUIPMENT = 10;

    #[NameAttribute('Breast Pumps')]
    #[PublicAttribute(true)]
    case BREAST_PUMPS = 11;

    #[NameAttribute('Other Breathing Aids')]
    #[PublicAttribute(true)]
    case OTHER_BREATHING_AIDS = 12;

    #[NameAttribute('Monitoring Equipment')]
    #[PublicAttribute(true)]
    case MONITORING_EQUIPMENT = 13;

    #[NameAttribute('Patient Lifts and Support Systems')]
    #[PublicAttribute(true)]
    case PATIENT_LIFTS_SUPPORT_SYSTEMS = 14;

    #[NameAttribute('Pneumatic Compressors and Appliances')]
    #[PublicAttribute(true)]
    case PNEUMATIC_COMPRESSORS_APPLIANCES = 15;

    #[NameAttribute('ULTRAVIOLET LIGHT THERAPY SYSTEMS')]
    #[PublicAttribute(true)]
    case ULTRAVIOLET_LIGHT_THERAPY_SYSTEMS = 16;

    #[NameAttribute('Safety Devices')]
    #[PublicAttribute(true)]
    case SAFETY_DEVICES = 17;

    #[NameAttribute('Stimulation Devices')]
    #[PublicAttribute(true)]
    case STIMULATION_DEVICES = 18;

    #[NameAttribute('Infusion Pumps and Supplies')]
    #[PublicAttribute(true)]
    case INFUSION_PUMPS_SUPPLIES = 19;

    #[NameAttribute('Traction and Other Orthopedic Devices')]
    #[PublicAttribute(true)]
    case TRACTION_OTHER_ORTHOPEDIC_DEVICES = 20;

    #[NameAttribute('Wheelchair Accessories')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_ACCESSORIES = 21;

    #[NameAttribute('Transport Chairs')]
    #[PublicAttribute(true)]
    case TRANSPORT_CHAIRS = 22;

    #[NameAttribute('Fully Reclining Wheelchairs')]
    #[PublicAttribute(true)]
    case FULLY_RECLINING_WHEELCHAIRS = 23;

    #[NameAttribute('Hemi-Wheelchairs')]
    #[PublicAttribute(true)]
    case HEMI_WHEELCHAIRS = 24;

    #[NameAttribute('Lightweight, High-strength Wheelchairs')]
    #[PublicAttribute(true)]
    case LIGHTWEIGHT_HIGH_STRENGTH_WHEELCHAIRS = 25;

    #[NameAttribute('Heavy Duty, Wide Wheelchairs')]
    #[PublicAttribute(true)]
    case HEAVY_DUTY_WIDE_WHEELCHAIRS = 26;

    #[NameAttribute('Semi-reclining Wheelchairs')]
    #[PublicAttribute(true)]
    case SEMI_RECLINING_WHEELCHAIRS = 27;

    #[NameAttribute('Standard Wheelchairs')]
    #[PublicAttribute(true)]
    case STANDARD_WHEELCHAIRS = 28;

    #[NameAttribute('Amputee Wheelchairs')]
    #[PublicAttribute(true)]
    case AMPUTEE_WHEELCHAIRS = 29;

    #[NameAttribute('Other Wheelchairs and Accessories')]
    #[PublicAttribute(true)]
    case OTHER_WHEELCHAIRS_ACCESSORIES = 30;

    #[NameAttribute('Pediatric Wheelchairs')]
    #[PublicAttribute(true)]
    case PEDIATRIC_WHEELCHAIRS = 31;

    #[NameAttribute('Lightweight Wheelchairs')]
    #[PublicAttribute(true)]
    case LIGHTWEIGHT_WHEELCHAIRS = 32;

    #[NameAttribute('Heavy Duty and Special Wheelchairs')]
    #[PublicAttribute(true)]
    case HEAVY_DUTY_SPECIAL_WHEELCHAIRS = 33;

    #[NameAttribute('Whirlpool Baths')]
    #[PublicAttribute(true)]
    case WHIRLPOOL_BATHS = 34;

    #[NameAttribute('Accessories for Oxygen Delivery Devices')]
    #[PublicAttribute(true)]
    case ACCESSORIES_OXYGEN_DELIVERY_DEVICES = 35;

    #[NameAttribute('Dialysis Systems and Accessories')]
    #[PublicAttribute(true)]
    case DIALYSIS_SYSTEMS_ACCESSORIES = 36;

    #[NameAttribute('Jaw Motion Rehabilitation Systems')]
    #[PublicAttribute(true)]
    case JAW_MOTION_REHABILITATION_SYSTEMS = 37;

    #[NameAttribute('Extension/Flexion Rehabilitation Devices')]
    #[PublicAttribute(true)]
    case EXTENSION_FLEXION_REHABILITATION_DEVICES = 38;

    #[NameAttribute('Communication Boards')]
    #[PublicAttribute(true)]
    case COMMUNICATION_BOARDS = 39;

    #[NameAttribute('Miscellaneous Pumps and Monitors')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PUMPS_MONITORS = 40;

    #[NameAttribute('Virtual Reality Cognitive Behavioral Therapy Device (CBT)')]
    #[PublicAttribute(true)]
    case VIRTUAL_REALITY_COGNITIVE_BEHAVIORAL_THERAPY_DEVICE_CBT = 41;

    #[NameAttribute('Manual Wheelchair Accessories')]
    #[PublicAttribute(true)]
    case MANUAL_WHEELCHAIR_ACCESSORIES = 42;

    #[NameAttribute('Power Wheelchair Accessories')]
    #[PublicAttribute(true)]
    case POWER_WHEELCHAIR_ACCESSORIES = 43;

    #[NameAttribute('Wound Therapy Pumps')]
    #[PublicAttribute(true)]
    case WOUND_THERAPY_PUMPS = 44;

    #[NameAttribute('Speech Generating Devices, Software, and Accessories')]
    #[PublicAttribute(true)]
    case SPEECH_GENERATING_DEVICES_SOFTWARE_ACCESSORIES = 45;

    #[NameAttribute('Wheelchair Seat and Back Cushions')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_SEAT_BACK_CUSHIONS = 46;

    #[NameAttribute('Wheelchair Mobile Arm Supports')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_MOBILE_ARM_SUPPORTS = 47;

    #[NameAttribute('Pediatric Gait Trainers')]
    #[PublicAttribute(true)]
    case PEDIATRIC_GAIT_TRAINERS = 48;
}
