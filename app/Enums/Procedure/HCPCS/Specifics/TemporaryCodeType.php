<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum TemporaryCodeType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Miscellaneous Drugs and Tests
    // Chemotherapy Anti-emetic Medications
    // COVID-19 Infusion Therapy
    // Ventricular Assist Devices
    // Pharmacy Supply and Dispensing Fees
    // Miscellaneous Drug and New Technology Codes
    // Influenza Virus Vaccines
    // Other Drugs and Service Fees
    // Cast and Splint Supplies
    // Miscellaneous Drugs
    // Skin Substitutes and Biologicals
    // Hospice and Home Health Care
    // Additional Miscellaneous Drugs
    // Anti-Inflammatory Medication and Chemotherapy Medication
    // Cancer and Vision Associated Drugs
    // Assessment and Couseling-Department of Veterans Affairs Chaplain Services
    // Contrast Agents/Diagnostic Imaging
    // Other Drugs and Test
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
