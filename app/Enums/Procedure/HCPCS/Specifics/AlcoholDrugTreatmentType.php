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

enum AlcoholDrugTreatmentType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Drug, Alcohol, and Behavioral Health Services')]
    #[RangeAttribute('H0001', 'H0030')]
    #[PublicAttribute(true)]
    case DRUG_ALCOHOL_BEHAVIORAL_HEALTH = 1;

    #[NameAttribute('Mental Health Programs and Medication Administration Training')]
    #[RangeAttribute('H0031', 'H0040')]
    #[PublicAttribute(true)]
    case MENTAL_HEALTH_PROGRAMS_MEDICATION_ADMINISTRATION_TRAINING = 2;

    #[NameAttribute('Foster Care')]
    #[RangeAttribute('H0041', 'H0042')]
    #[PublicAttribute(true)]
    case FOSTER_CARE = 3;

    #[NameAttribute('Supported Housing')]
    #[RangeAttribute('H0043', 'H0044')]
    #[PublicAttribute(true)]
    case SUPPORTED_HOUSING = 4;

    #[NameAttribute('Miscellaneous Drug and Alcohol Services')]
    #[RangeAttribute('H0045', 'H0050')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUG_ALCOHOL = 5;

    #[NameAttribute('Prenatal Care and Family Planning Assessment')]
    #[RangeAttribute('H1000', 'H1011')]
    #[PublicAttribute(true)]
    case PRENATAL_CARE_FAMILY_PLANNING_ASSESSMENT = 6;

    #[NameAttribute('Other Mental Health and Community Support Services')]
    #[RangeAttribute('H2000', 'H2038')]
    #[PublicAttribute(true)]
    case OTHER_MENTAL_HEALTH_COMMUNITY_SUPPORT = 7;
}
