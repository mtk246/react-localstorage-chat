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

enum DrugsOtherOralMethodType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Drugs, Administered by Injection')]
    #[RangeAttribute('J0120', 'J7175')]
    #[PublicAttribute(true)]
    case DRUG_ADMINISTER_INJECTION = 1;

    #[NameAttribute('Clotting Factors')]
    #[RangeAttribute('J7177', 'J7212')]
    #[PublicAttribute(true)]
    case CLOTTING_FACTORS = 2;

    #[NameAttribute('Contraceptive Systems')]
    #[RangeAttribute('J7294', 'J7307')]
    #[PublicAttribute(true)]
    case CONTRACEPTIVE_SYSTEMS = 3;

    #[NameAttribute('Miscellaneous Drugs')]
    #[RangeAttribute('J7308', 'J7402')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS = 4;

    #[NameAttribute('Immunosuppressive Drugs')]
    #[RangeAttribute('J7500', 'J7599')]
    #[PublicAttribute(true)]
    case IMMUNOSUPPRESSIVE_DRUGS = 5;

    #[NameAttribute('Inhalation Solutions')]
    #[RangeAttribute('J7604', 'J7686')]
    #[PublicAttribute(true)]
    case INHALATION_SOLUTIONS = 6;

    #[NameAttribute('Drugs, Not Otherwise Classified')]
    #[RangeAttribute('J7699', 'J8499')]
    #[PublicAttribute(true)]
    case DRUGS_NOT_OTHERWISE_CLASSIFIED = 7;

    #[NameAttribute('Chemotherapy Drugs, Oral Administration')]
    #[RangeAttribute('J8501', 'J8999')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_DRUGS_ORAL_ADMINISTRATION = 8;
}
