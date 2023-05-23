<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum NationalCodeType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Nursing Services
    // Alcohol and Substance Abuse Services
    // Other Services
    // Home Health Services
    // Screenings, Assessments, and Treatments, Individual and Family
    // Additional Nursing Services
    // Doula Birth Worker Services
    // Behavioral Health Services
    // Miscellaneous Services and Supplies
    // Transportation Services
    // Preadmission Screening
    // Waiver Services
    // Hospice Care
    // Prevocational Habilitation Waiver Services
    // Long-term Residential Care
    // Non-emergency Transportation Fees
    // Financial Management and Supports Brokerage Services, Per Diem
    // Services Related to Breast Milk
    // Incontinence Supplies
    // Other and Unspecified Supplies
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
