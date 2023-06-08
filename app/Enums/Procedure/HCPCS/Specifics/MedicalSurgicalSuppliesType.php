<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum MedicalSurgicalSuppliesType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Injection and Infusion Supplies')]
    #[PublicAttribute(true)]
    case INJECTION_INFUSION_SUPPLIES = 1;

    #[NameAttribute('Replacement Batteries')]
    #[PublicAttribute(true)]
    case REPLACEMENT_BATTERIES = 2;

    #[NameAttribute('Other Supplies Including Diabetes Supplies and Contraceptives')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES_INCLUDING_DIABETES_SUPPLIES_CONTRACEPTIVES = 3;

    #[NameAttribute('Access Catheters and Drug Delivery Systems')]
    #[PublicAttribute(true)]
    case ACCESS_CATHETERS_DRUG_DELIVERY_SYSTEMS = 4;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES = 5;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES = 6;

    #[NameAttribute('Various Medical Supplies Including Tapes and Surgical Dressings')]
    #[PublicAttribute(true)]
    case VARIOUS_MEDICAL_SUPPLIES_INCLUDING_TAPES_SURGICAL_DRESSINGS = 7;

    #[NameAttribute('Respiratory Supplies and Equipment')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SUPPLIES_EQUIPMENT = 8;

    #[NameAttribute('Replacement Parts')]
    #[PublicAttribute(true)]
    case REPLACEMENT_PARTS = 9;

    #[NameAttribute('Diagnostic Radiopharmaceuticals')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_RADIOPHARMACEUTICALS = 10;

    #[NameAttribute('Other Supplies')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES = 11;

    #[NameAttribute('Dialysis Equipment and Supplies')]
    #[PublicAttribute(true)]
    case DIALYSIS_EQUIPMENT_SUPPLIES = 12;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES_new = 13;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES_new = 14;

    #[NameAttribute('Diabetic Footwear')]
    #[PublicAttribute(true)]
    case DIABETIC_FOOTWEAR = 15;

    #[NameAttribute('Miscellaneous Dressing and Wound Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRESSING_WOUND_SUPPLIES = 16;

    #[NameAttribute('Foam Dressings')]
    #[PublicAttribute(true)]
    case FOAM_DRESSINGS = 17;

    #[NameAttribute('Gauze Dressings')]
    #[PublicAttribute(true)]
    case GAUZE_DRESSINGS = 18;

    #[NameAttribute('Hydrocolloid Dressings')]
    #[PublicAttribute(true)]
    case HYDROCOLLOID_DRESSINGS = 19;

    #[NameAttribute('Hydrogel Dressings')]
    #[PublicAttribute(true)]
    case HYDROGEL_DRESSINGS = 20;

    #[NameAttribute('Other Dressings, Coverings, and Wound Treatment Supplies')]
    #[PublicAttribute(true)]
    case OTHER_DRESSINGS_COVERINGS_WOUND_TREATMENT_SUPPLIES = 21;

    #[NameAttribute('Bandages')]
    #[PublicAttribute(true)]
    case BANDAGES = 22;

    #[NameAttribute('Compression Garments and Stockings')]
    #[PublicAttribute(true)]
    case COMPRESSION_GARMENTS_STOCKINGS = 23;

    #[NameAttribute('External Urinary Catheters (Disposable and Non-Disposable)')]
    #[PublicAttribute(true)]
    case EXTERNAL_URINARY_CATHETERS_DISPOSABLE_NON_DISPOSABLE = 24;

    #[NameAttribute('Breathing Aids')]
    #[PublicAttribute(true)]
    case BREATHING_AIDS = 25;

    #[NameAttribute('Tracheostoma Supplies')]
    #[PublicAttribute(true)]
    case TRACHEOSTOMA_SUPPLIES = 26;

    #[NameAttribute('Helmets')]
    #[PublicAttribute(true)]
    case HELMETS = 27;
}
