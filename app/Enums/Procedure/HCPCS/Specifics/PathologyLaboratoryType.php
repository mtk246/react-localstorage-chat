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

enum PathologyLaboratoryType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Laboratory Tests of Blood and Hair')]
    #[RangeAttribute('P2028', 'P2038')]
    #[PublicAttribute(true)]
    case LABORATORY_TESTS_BLOD_HAIR = 1;

    #[NameAttribute('Pap Smears')]
    #[RangeAttribute('P3000', 'P3001')]
    #[PublicAttribute(true)]
    case PAP_SMERAS = 2;

    #[NameAttribute('Urine Bacterial Culture and Sensitivity Studies')]
    #[RangeAttribute('P7001', 'P7001')]
    #[PublicAttribute(true)]
    case URINE_BACTERIAL_CULTURE_SENSITIVITY_STUDIES = 3;

    #[NameAttribute('Blood and Blood Products, with Associated Procedures')]
    #[RangeAttribute('P9010', 'P9100')]
    #[PublicAttribute(true)]
    case BLOOD_BLOOD_PRODUCTS_WITH_ASSOCIATED_PROCEDURES = 4;

    #[NameAttribute('Specimen Collection, Travel Allowance')]
    #[RangeAttribute('P9603', 'P9604')]
    #[PublicAttribute(true)]
    case SPECIMEN_COLLECTION_TRAVEL_ALLOWANCE = 5;

    #[NameAttribute('Specimen Collection, Catheterization')]
    #[RangeAttribute('P9612', 'P9615')]
    #[PublicAttribute(true)]
    case SPECIMEN_COLLECTION_CATHETERIZATION = 6;
}
