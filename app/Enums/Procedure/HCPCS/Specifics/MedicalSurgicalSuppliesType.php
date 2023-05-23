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

    // Injection and Infusion Supplies
    // Replacement Batteries
    // Other Supplies Including Diabetes Supplies and Contraceptives
    // Access Catheters and Drug Delivery Systems
    // Incontinence Devices and Supplies
    // Ostomy Pouches and Supplies
    // Various Medical Supplies Including Tapes and Surgical Dressings
    // Respiratory Supplies and Equipment
    // Replacement Parts
    // Diagnostic Radiopharmaceuticals
    // Other Supplies
    // Dialysis Equipment and Supplies
    // Ostomy Pouches and Supplies
    // Incontinence Devices and Supplies
    // Diabetic Footwear
    // Miscellaneous Dressing and Wound Supplies
    // Foam Dressings
    // Gauze Dressings
    // Hydrocolloid Dressings
    // Hydrogel Dressings
    // Other Dressings, Coverings, and Wound Treatment Supplies
    // Bandages
    // Compression Garments and Stockings
    // External Urinary Catheters (Disposable and Non-Disposable)
    // Breathing Aids
    // Tracheostoma Supplies
    // Helmets
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
