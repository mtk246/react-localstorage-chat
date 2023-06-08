<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum MatrixWoundManagementType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Medical And Surgical Supplies
    // Injection and Infusion Supplies
    // Replacement Batteries
    // Other Supplies Including Diabetes Supplies and Contraceptives
    // Access Catheters and Drug Delivery Systems
    // 0Incontinence Devices and Supplies
    // Ostomy Pouches and Supplies
    // Various Medical Supplies Including Tapes and Surgical Dressings
    // Respiratory Supplies and Equipment
    // Replacement Parts
    // Diagnostic Radiopharmaceuticals

    #[NameAttribute('Medical And Surgical Supplies')]
    #[PublicAttribute(true)]
    case MEDICAL_SURGICAL_SUPPLIES = 1;

    #[NameAttribute('Injection and Infusion Supplies')]
    #[PublicAttribute(true)]
    case INJECTION_INFUSION_SUPPLIES = 2;

    #[NameAttribute('Replacement Batteries')]
    #[PublicAttribute(true)]
    case REPLACEMENT_BATTERIES = 3;

    #[NameAttribute('Other Supplies Including Diabetes Supplies and Contraceptives')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES_INCLUDING_DIABETES_SUPPLIES_CONTRACEPTIVES = 4;

    #[NameAttribute('Access Catheters and Drug Delivery Systems')]
    #[PublicAttribute(true)]
    case ACCESS_CATHETERS_DRUG_DELIVERY_SYSTEMS = 5;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES = 6;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES = 7;

    #[NameAttribute('Various Medical Supplies Including Tapes and Surgical Dressings')]
    #[PublicAttribute(true)]
    case VARIOUS_MEDICAL_SUPPLIES_INCLUDING_TAPES_SURGICAL_DRESSINGS = 8;

    #[NameAttribute('Respiratory Supplies and Equipment')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SUPPLIES_EQUIPMENT = 9;

    #[NameAttribute('Replacement Parts')]
    #[PublicAttribute(true)]
    case REPLACEMENT_PARTS = 10;

    #[NameAttribute('Diagnostic Radiopharmaceuticals')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_RADIOPHARMACEUTICALS = 11;

    #[NameAttribute('Other Supplies')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES = 12;

    #[NameAttribute('Dialysis Equipment and Supplies')]
    #[PublicAttribute(true)]
    case DIALYSIS_EQUIPMENT_SUPPLIES = 13;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES_NEW = 14;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES_NEW = 15;

    #[NameAttribute('Diabetic Footwear')]
    #[PublicAttribute(true)]
    case DIABETIC_FOOTWEAR = 16;

    #[NameAttribute('Miscellaneous Dressing and Wound Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRESSING_WOUND_SUPPLIES = 17;

    #[NameAttribute('Foam Dressings')]
    #[PublicAttribute(true)]
    case FOAM_DRESSINGS = 18;

    #[NameAttribute('Gauze Dressings')]
    #[PublicAttribute(true)]
    case GAUZE_DRESSINGS = 19;

    #[NameAttribute('Hydrocolloid Dressings')]
    #[PublicAttribute(true)]
    case HYDROCOLLOID_DRESSINGS = 20;

    #[NameAttribute('Hydrogel Dressings')]
    #[PublicAttribute(true)]
    case HYDROGEL_DRESSINGS = 21;

    #[NameAttribute('Other Dressings, Coverings, and Wound Treatment Supplies')]
    #[PublicAttribute(true)]
    case OTHER_DRESSINGS_COVERINGS_WOUND_TREATMENT_SUPPLIES = 22;

    #[NameAttribute('Bandages')]
    #[PublicAttribute(true)]
    case BANDAGES = 23;

    #[NameAttribute('Compression Garments and Stockings')]
    #[PublicAttribute(true)]
    case COMPRESSION_GARMENTS_STOCKINGS = 24;

    #[NameAttribute('External Urinary Catheters (Disposable and Non-Disposable)')]
    #[PublicAttribute(true)]
    case EXTERNAL_URINARY_CATHETERS_DISPOSABLE_NON_DISPOSABLE = 25;

    #[NameAttribute('Breathing Aids')]
    #[PublicAttribute(true)]
    case BREATHING_AIDS = 26;

    #[NameAttribute('Tracheostoma Supplies')]
    #[PublicAttribute(true)]
    case TRACHEOSTOMA_SUPPLIES = 27;

    #[NameAttribute('Helmets')]
    #[PublicAttribute(true)]
    case HELMETS = 28;
}
