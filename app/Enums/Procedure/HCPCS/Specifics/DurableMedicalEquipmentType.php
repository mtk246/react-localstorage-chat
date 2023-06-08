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

enum DurableMedicalEquipmentType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Walking Aids and Attachments ')]
    #[RangeAttribute('E0100', 'E0159')]
    #[PublicAttribute(true)]
    case WALKING_AIDS_ATTACHMENTS = 1;

    #[NameAttribute('Sitz Bath/Equipment')]
    #[RangeAttribute('E0160', 'E0162')]
    #[PublicAttribute(true)]
    case SITZ_BATH_EQUIPMENT = 2;

    #[NameAttribute('Commode Chair and Supplies')]
    #[RangeAttribute('E0163', 'E0175')]
    #[PublicAttribute(true)]
    case COMMODE_CHAIR_SUPPLIES = 3;

    #[NameAttribute('Pressure Mattresses, Pads, and Other Supplies')]
    #[RangeAttribute('E0181', 'E0199')]
    #[PublicAttribute(true)]
    case PRESSURE_MATTRESSES_PADS_OTHER_SUPPLIES = 4;

    #[NameAttribute('Heat, Cold, and Light Therapies')]
    #[RangeAttribute('E0200', 'E0239')]
    #[PublicAttribute(true)]
    case HEAT_COLD_LIGHT_THERAPIES = 5;

    #[NameAttribute('Bathing Supplies')]
    #[RangeAttribute('E0240', 'E0249')]
    #[PublicAttribute(true)]
    case BATHING_SUPPLIES = 6;

    #[NameAttribute('Hospital Beds and Associated Supplies')]
    #[RangeAttribute('E0250', 'E0373')]
    #[PublicAttribute(true)]
    case HOSPITAL_BEDS_ASSOCIATED_SUPPLIES = 7;

    #[NameAttribute('Oxygen Delivery Systems and Related Supplies')]
    #[RangeAttribute('E0424', 'E0487')]
    #[PublicAttribute(true)]
    case OXYGEN_DELIVERY_SYSTEMS_RELATED_SUPPLIES = 8;

    #[NameAttribute('Intermittent Positive Pressure Breathing Devices')]
    #[RangeAttribute('E0500', 'E0500')]
    #[PublicAttribute(true)]
    case INTERMITTENT_POSITIVE_PRESSURE_BREATHING_DEVICES = 9;

    #[NameAttribute('Humidifiers and Nebulizers with Related Equipment')]
    #[RangeAttribute('E0550', 'E0601')]
    #[PublicAttribute(true)]
    case HUMIDIFIERS_NEBULIZERS_RELATED_EQUIPMENT = 10;

    #[NameAttribute('Breast Pumps')]
    #[RangeAttribute('E0602', 'E0604')]
    #[PublicAttribute(true)]
    case BREAST_PUMPS = 11;

    #[NameAttribute('Other Breathing Aids')]
    #[RangeAttribute('E0605', 'E0606')]
    #[PublicAttribute(true)]
    case OTHER_BREATHING_AIDS = 12;

    #[NameAttribute('Monitoring Equipment')]
    #[RangeAttribute('E0607', 'E0620')]
    #[PublicAttribute(true)]
    case MONITORING_EQUIPMENT = 13;

    #[NameAttribute('Patient Lifts and Support Systems')]
    #[RangeAttribute('E0621', 'E0642')]
    #[PublicAttribute(true)]
    case PATIENT_LIFTS_SUPPORT_SYSTEMS = 14;

    #[NameAttribute('Pneumatic Compressors and Appliances')]
    #[RangeAttribute('E0650', 'E0677')]
    #[PublicAttribute(true)]
    case PNEUMATIC_COMPRESSORS_APPLIANCES = 15;

    #[NameAttribute('ULTRAVIOLET LIGHT THERAPY SYSTEMS')]
    #[RangeAttribute('E0691', 'E0694')]
    #[PublicAttribute(true)]
    case ULTRAVIOLET_LIGHT_THERAPY_SYSTEMS = 16;

    #[NameAttribute('Safety Devices')]
    #[RangeAttribute('E0700', 'E0711')]
    #[PublicAttribute(true)]
    case SAFETY_DEVICES = 17;

    #[NameAttribute('Stimulation Devices')]
    #[RangeAttribute('E0720', 'E0770')]
    #[PublicAttribute(true)]
    case STIMULATION_DEVICES = 18;

    #[NameAttribute('Infusion Pumps and Supplies')]
    #[RangeAttribute('E0776', 'E0791')]
    #[PublicAttribute(true)]
    case INFUSION_PUMPS_SUPPLIES = 19;

    #[NameAttribute('Traction and Other Orthopedic Devices')]
    #[RangeAttribute('E0830', 'E0948')]
    #[PublicAttribute(true)]
    case TRACTION_OTHER_ORTHOPEDIC_DEVICES = 20;

    #[NameAttribute('Wheelchair Accessories')]
    #[RangeAttribute('E0950', 'E1036')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_ACCESSORIES = 21;

    #[NameAttribute('Transport Chairs')]
    #[RangeAttribute('E1037', 'E1039')]
    #[PublicAttribute(true)]
    case TRANSPORT_CHAIRS = 22;

    #[NameAttribute('Fully Reclining Wheelchairs')]
    #[RangeAttribute('E1050', 'E1070')]
    #[PublicAttribute(true)]
    case FULLY_RECLINING_WHEELCHAIRS = 23;

    #[NameAttribute('Hemi-Wheelchairs')]
    #[RangeAttribute('E1083', 'E1086')]
    #[PublicAttribute(true)]
    case HEMI_WHEELCHAIRS = 24;

    #[NameAttribute('Lightweight, High-strength Wheelchairs')]
    #[RangeAttribute('E1087', 'E1090')]
    #[PublicAttribute(true)]
    case LIGHTWEIGHT_HIGH_STRENGTH_WHEELCHAIRS = 25;

    #[NameAttribute('Heavy Duty, Wide Wheelchairs')]
    #[RangeAttribute('E1092', 'E1093')]
    #[PublicAttribute(true)]
    case HEAVY_DUTY_WIDE_WHEELCHAIRS = 26;

    #[NameAttribute('Semi-reclining Wheelchairs')]
    #[RangeAttribute('E1100', 'E1110')]
    #[PublicAttribute(true)]
    case SEMI_RECLINING_WHEELCHAIRS = 27;

    #[NameAttribute('Standard Wheelchairs')]
    #[RangeAttribute('E1130', 'E1161')]
    #[PublicAttribute(true)]
    case STANDARD_WHEELCHAIRS = 28;

    #[NameAttribute('Amputee Wheelchairs')]
    #[RangeAttribute('E1170', 'E1200')]
    #[PublicAttribute(true)]
    case AMPUTEE_WHEELCHAIRS = 29;

    #[NameAttribute('Other Wheelchairs and Accessories')]
    #[RangeAttribute('E1220', 'E1228')]
    #[PublicAttribute(true)]
    case OTHER_WHEELCHAIRS_ACCESSORIES = 30;

    #[NameAttribute('Pediatric Wheelchairs')]
    #[RangeAttribute('E1229', 'E1239')]
    #[PublicAttribute(true)]
    case PEDIATRIC_WHEELCHAIRS = 31;

    #[NameAttribute('Lightweight Wheelchairs')]
    #[RangeAttribute('E1240', 'E1270')]
    #[PublicAttribute(true)]
    case LIGHTWEIGHT_WHEELCHAIRS = 32;

    #[NameAttribute('Heavy Duty and Special Wheelchairs')]
    #[RangeAttribute('E1280', 'E1298')]
    #[PublicAttribute(true)]
    case HEAVY_DUTY_SPECIAL_WHEELCHAIRS = 33;

    #[NameAttribute('Whirlpool Baths')]
    #[RangeAttribute('E1300', 'E1310')]
    #[PublicAttribute(true)]
    case WHIRLPOOL_BATHS = 34;

    #[NameAttribute('Accessories for Oxygen Delivery Devices')]
    #[RangeAttribute('E1352', 'E1406')]
    #[PublicAttribute(true)]
    case ACCESSORIES_OXYGEN_DELIVERY_DEVICES = 35;

    #[NameAttribute('Dialysis Systems and Accessories')]
    #[RangeAttribute('E1500', 'E1699')]
    #[PublicAttribute(true)]
    case DIALYSIS_SYSTEMS_ACCESSORIES = 36;

    #[NameAttribute('Jaw Motion Rehabilitation Systems')]
    #[RangeAttribute('E1700', 'E1702')]
    #[PublicAttribute(true)]
    case JAW_MOTION_REHABILITATION_SYSTEMS = 37;

    #[NameAttribute('Extension/Flexion Rehabilitation Devices')]
    #[RangeAttribute('E1800', 'E1841')]
    #[PublicAttribute(true)]
    case EXTENSION_FLEXION_REHABILITATION_DEVICES = 38;

    #[NameAttribute('Communication Boards')]
    #[RangeAttribute('E1902', 'E1902')]
    #[PublicAttribute(true)]
    case COMMUNICATION_BOARDS = 39;

    #[NameAttribute('Miscellaneous Pumps and Monitors')]
    #[RangeAttribute('E2000', 'E2120')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PUMPS_MONITORS = 40;

    #[NameAttribute('Virtual Reality Cognitive Behavioral Therapy Device (CBT)')]
    #[RangeAttribute('E1905', 'E1905')]
    #[PublicAttribute(true)]
    case VIRTUAL_REALITY_COGNITIVE_BEHAVIORAL_THERAPY_DEVICE_CBT = 41;

    #[NameAttribute('Manual Wheelchair Accessories')]
    #[RangeAttribute('E2201', 'E2295')]
    #[PublicAttribute(true)]
    case MANUAL_WHEELCHAIR_ACCESSORIES = 42;

    #[NameAttribute('Power Wheelchair Accessories')]
    #[RangeAttribute('E2300', 'E2398')]
    #[PublicAttribute(true)]
    case POWER_WHEELCHAIR_ACCESSORIES = 43;

    #[NameAttribute('Wound Therapy Pumps')]
    #[RangeAttribute('E2402', 'E2402')]
    #[PublicAttribute(true)]
    case WOUND_THERAPY_PUMPS = 44;

    #[NameAttribute('Speech Generating Devices, Software, and Accessories')]
    #[RangeAttribute('E2500', 'E2599')]
    #[PublicAttribute(true)]
    case SPEECH_GENERATING_DEVICES_SOFTWARE_ACCESSORIES = 45;

    #[NameAttribute('Wheelchair Seat and Back Cushions')]
    #[RangeAttribute('E2601', 'E2625')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_SEAT_BACK_CUSHIONS = 46;

    #[NameAttribute('Wheelchair Mobile Arm Supports')]
    #[RangeAttribute('E2626', 'E2633')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_MOBILE_ARM_SUPPORTS = 47;

    #[NameAttribute('Pediatric Gait Trainers')]
    #[RangeAttribute('E8000', 'E8002')]
    #[PublicAttribute(true)]
    case PEDIATRIC_GAIT_TRAINERS = 48;
}
