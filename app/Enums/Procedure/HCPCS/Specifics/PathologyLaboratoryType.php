<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum PathologyLaboratoryType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Laboratory Tests of Blood and Hair
    // Pap Smears
    // Urine Bacterial Culture and Sensitivity Studies
    // Blood and Blood Products, with Associated Procedures
    // Specimen Collection, Travel Allowance
    // Specimen Collection, Catheterization
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
