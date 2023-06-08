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

    #[NameAttribute('Laboratory Tests of Blood and Hair')]
    #[PublicAttribute(true)]
    case LABORATORY_TESTS_BLOD_HAIR = 1;

    #[NameAttribute('Pap Smears')]
    #[PublicAttribute(true)]
    case PAP_SMERAS = 2;

    #[NameAttribute('Urine Bacterial Culture and Sensitivity Studies')]
    #[PublicAttribute(true)]
    case URINE_BACTERIAL_CULTURE_SENSITIVITY_STUDIES = 3;

    #[NameAttribute('Blood and Blood Products, with Associated Procedures')]
    #[PublicAttribute(true)]
    case BLOOD_BLOOD_PRODUCTS_WITH_ASSOCIATED_PROCEDURES = 4;

    #[NameAttribute('Specimen Collection, Travel Allowance')]
    #[PublicAttribute(true)]
    case SPECIMEN_COLLECTION_TRAVEL_ALLOWANCE = 5;

    #[NameAttribute('Specimen Collection, Catheterization')]
    #[PublicAttribute(true)]
    case SPECIMEN_COLLECTION_CATHETERIZATION = 6;
}
