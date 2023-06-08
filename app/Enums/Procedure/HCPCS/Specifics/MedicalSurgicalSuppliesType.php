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

enum MedicalSurgicalSuppliesType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Injection and Infusion Supplies')]
    #[RangeAttribute('A4206', 'A4232')]
    #[PublicAttribute(true)]
    case INJECTION_INFUSION_SUPPLIES = 1;

    #[NameAttribute('Replacement Batteries')]
    #[RangeAttribute('A4233', 'A4239')]
    #[PublicAttribute(true)]
    case REPLACEMENT_BATTERIES = 2;

    #[NameAttribute('Other Supplies Including Diabetes Supplies and Contraceptives')]
    #[RangeAttribute('A4244', 'A4290')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES_INCLUDING_DIABETES_SUPPLIES_CONTRACEPTIVES = 3;

    #[NameAttribute('Access Catheters and Drug Delivery Systems')]
    #[RangeAttribute('A4300', 'A4306')]
    #[PublicAttribute(true)]
    case ACCESS_CATHETERS_DRUG_DELIVERY_SYSTEMS = 4;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[RangeAttribute('A4310', 'A4360')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES = 5;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[RangeAttribute('A4361', 'A4437')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES = 6;

    #[NameAttribute('Various Medical Supplies Including Tapes and Surgical Dressings')]
    #[RangeAttribute('A4450', 'A4608')]
    #[PublicAttribute(true)]
    case VARIOUS_MEDICAL_SUPPLIES_INCLUDING_TAPES_SURGICAL_DRESSINGS = 7;

    #[NameAttribute('Respiratory Supplies and Equipment')]
    #[RangeAttribute('A4611', 'A4629')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SUPPLIES_EQUIPMENT = 8;

    #[NameAttribute('Replacement Parts')]
    #[RangeAttribute('A4630', 'A4640')]
    #[PublicAttribute(true)]
    case REPLACEMENT_PARTS = 9;

    #[NameAttribute('Diagnostic Radiopharmaceuticals')]
    #[RangeAttribute('A4641', 'A4642')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_RADIOPHARMACEUTICALS = 10;

    #[NameAttribute('Other Supplies')]
    #[RangeAttribute('A4648', 'A4652')]
    #[PublicAttribute(true)]
    case OTHER_SUPPLIES = 11;

    #[NameAttribute('Dialysis Equipment and Supplies')]
    #[RangeAttribute('A4653', 'A4932')]
    #[PublicAttribute(true)]
    case DIALYSIS_EQUIPMENT_SUPPLIES = 12;

    #[NameAttribute('Ostomy Pouches and Supplies')]
    #[RangeAttribute('A5051', 'A5093')]
    #[PublicAttribute(true)]
    case OSTOMY_POUCHES_SUPPLIES_new = 13;

    #[NameAttribute('Incontinence Devices and Supplies')]
    #[RangeAttribute('A5102', 'A5200')]
    #[PublicAttribute(true)]
    case INCONTINENCE_DEVICES_SUPPLIES_new = 14;

    #[NameAttribute('Diabetic Footwear')]
    #[RangeAttribute('A5500', 'A5514')]
    #[PublicAttribute(true)]
    case DIABETIC_FOOTWEAR = 15;

    #[NameAttribute('Miscellaneous Dressing and Wound Supplies')]
    #[RangeAttribute('A6000', 'A6208')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRESSING_WOUND_SUPPLIES = 16;

    #[NameAttribute('Foam Dressings')]
    #[RangeAttribute('A6209', 'A6215')]
    #[PublicAttribute(true)]
    case FOAM_DRESSINGS = 17;

    #[NameAttribute('Gauze Dressings')]
    #[RangeAttribute('A6216', 'A6233')]
    #[PublicAttribute(true)]
    case GAUZE_DRESSINGS = 18;

    #[NameAttribute('Hydrocolloid Dressings')]
    #[RangeAttribute('A6234', 'A6241')]
    #[PublicAttribute(true)]
    case HYDROCOLLOID_DRESSINGS = 19;

    #[NameAttribute('Hydrogel Dressings')]
    #[RangeAttribute('A6242', 'A6248')]
    #[PublicAttribute(true)]
    case HYDROGEL_DRESSINGS = 20;

    #[NameAttribute('Other Dressings, Coverings, and Wound Treatment Supplies')]
    #[RangeAttribute('A6250', 'A6412')]
    #[PublicAttribute(true)]
    case OTHER_DRESSINGS_COVERINGS_WOUND_TREATMENT_SUPPLIES = 21;

    #[NameAttribute('Bandages')]
    #[RangeAttribute('A6413', 'A6461')]
    #[PublicAttribute(true)]
    case BANDAGES = 22;

    #[NameAttribute('Compression Garments and Stockings')]
    #[RangeAttribute('A6501', 'A6550')]
    #[PublicAttribute(true)]
    case COMPRESSION_GARMENTS_STOCKINGS = 23;

    #[NameAttribute('External Urinary Catheters (Disposable and Non-Disposable)')]
    #[RangeAttribute('A6590', 'A6591')]
    #[PublicAttribute(true)]
    case EXTERNAL_URINARY_CATHETERS_DISPOSABLE_NON_DISPOSABLE = 24;

    #[NameAttribute('Breathing Aids')]
    #[RangeAttribute('A7000', 'A7049')]
    #[PublicAttribute(true)]
    case BREATHING_AIDS = 25;

    #[NameAttribute('Tracheostoma Supplies')]
    #[RangeAttribute('A7501', 'A7527')]
    #[PublicAttribute(true)]
    case TRACHEOSTOMA_SUPPLIES = 26;

    #[NameAttribute('Helmets')]
    #[RangeAttribute('A8000', 'A8004')]
    #[PublicAttribute(true)]
    case HELMETS = 27;
}
