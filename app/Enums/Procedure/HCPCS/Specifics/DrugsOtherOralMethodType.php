<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum DrugsOtherOralMethodType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Drugs, Administered by Injection')]
    #[PublicAttribute(true)]
    case DRUG_ADMINISTER_INJECTION = 1;

    #[NameAttribute('Clotting Factors')]
    #[PublicAttribute(true)]
    case CLOTTING_FACTORS = 2;

    #[NameAttribute('Contraceptive Systems')]
    #[PublicAttribute(true)]
    case CONTRACEPTIVE_SYSTEMS = 3;

    #[NameAttribute('Miscellaneous Drugs')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS = 4;

    #[NameAttribute('Immunosuppressive Drugs')]
    #[PublicAttribute(true)]
    case IMMUNOSUPPRESSIVE_DRUGS = 5;

    #[NameAttribute('Inhalation Solutions')]
    #[PublicAttribute(true)]
    case INHALATION_SOLUTIONS = 6;

    #[NameAttribute('Drugs, Not Otherwise Classified')]
    #[PublicAttribute(true)]
    case DRUGS_NOT_OTHERWISE_CLASSIFIED = 7;

    #[NameAttribute('Chemotherapy Drugs, Oral Administration')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_DRUGS_ORAL_ADMINISTRATION = 8;
}
