<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum AlcoholDrugTreatmentType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Drug, Alcohol, and Behavioral Health Services')]
    #[PublicAttribute(true)]
    case DRUG_ALCOHOL_BEHAVIORAL_HEALTH = 1;

    #[NameAttribute('Mental Health Programs and Medication Administration Training')]
    #[PublicAttribute(true)]
    case MENTAL_HEALTH_PROGRAMS_MEDICATION_ADMINISTRATION_TRAINING = 2;

    #[NameAttribute('Foster Care')]
    #[PublicAttribute(true)]
    case FOSTER_CARE = 3;

    #[NameAttribute('Supported Housing')]
    #[PublicAttribute(true)]
    case SUPPORTED_HOUSING = 4;

    #[NameAttribute('Miscellaneous Drug and Alcohol Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUG_ALCOHOL = 5;

    #[NameAttribute('Prenatal Care and Family Planning Assessment')]
    #[PublicAttribute(true)]
    case PRENATAL_CARE_FAMILY_PLANNING_ASSESSMENT = 6;

    #[NameAttribute('Other Mental Health and Community Support Services')]
    #[PublicAttribute(true)]
    case OTHER_MENTAL_HEALTH_COMMUNITY_SUPPORT = 7;
}
