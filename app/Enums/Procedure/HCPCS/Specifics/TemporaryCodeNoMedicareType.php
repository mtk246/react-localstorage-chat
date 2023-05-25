<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum TemporaryCodeNoMedicareType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Non-Medicare Drug Codes
    // Miscellaneous Provider Services
    // Vision Supplies
    // Screenings and Examinations
    // Miscellaneous Provider Services and Supplies
    // Genetic Testing
    // Miscellaneous Tests
    // ASSORTED OBSTETRICAL AND FERTILITY SERVICES
    // Miscellaneous Medications and Therapeutic Substances
    // Various Home Care Services
    // Home Infusion Therapy
    // Insulin and Delivery Devices
    // Imaging Studies
    // Assisted Breathing Supplies
    // Miscellaneous Supplies and Services
    // Home Management of Pregnancy
    // Home Infusion Therapy
    // Miscellaneous Supplies and Services
    // Home Therapy Services
    // Various Services, Fees, and Costs
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
