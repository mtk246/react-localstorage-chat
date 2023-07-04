<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Intestinal infectious diseases')]
    #[RangeAttribute('A00-A09')]
    #[PublicAttribute(true)]
    case INTESTINAL_INFECTIOUS_DISEASES = 1;

    #[NameAttribute('Tuberculosis')]
    #[RangeAttribute('A15-A19')]
    #[PublicAttribute(true)]
    case TUBERCULOSIS = 2;

    #[NameAttribute('Certain zoonotic bacterial diseases')]
    #[RangeAttribute('A20-A28')]
    #[PublicAttribute(true)]
    case ZOONOTIC_BACTERIAL_DISEASES = 3;

    #[NameAttribute('Other bacterial diseases')]
    #[RangeAttribute('A30-A49')]
    #[PublicAttribute(true)]
    case OTHER_BACTERIAL_DISEASES = 4;

    #[NameAttribute('Infections with a predominantly sexual mode of transmission')]
    #[RangeAttribute('A50-A64')]
    #[PublicAttribute(true)]
    case SEXUALLY_TRANSMITTED_INFECTIONS = 5;

    #[NameAttribute('Other spirochetal diseases')]
    #[RangeAttribute('A65-A69')]
    #[PublicAttribute(true)]
    case OTHER_SPIROCHETAL_DISEASES = 6;

    #[NameAttribute('Other diseases caused by chlamydiae')]
    #[RangeAttribute('A70-A74')]
    #[PublicAttribute(true)]
    case OTHER_CHLAMYDIAE_DISEASES = 7;

    #[NameAttribute('Rickettsioses')]
    #[RangeAttribute('A75-A79')]
    #[PublicAttribute(true)]
    case RICKETTSIOSES = 8;

    #[NameAttribute('Viral and prion infections of the central nervous system')]
    #[RangeAttribute('A80-A89')]
    #[PublicAttribute(true)]
    case CENTRAL_NERVOUS_SYSTEM_INFECTIONS = 9;

    #[NameAttribute('Arthropod-borne viral fevers and viral hemorrhagic fevers')]
    #[RangeAttribute('A90-A99')]
    #[PublicAttribute(true)]
    case ARTHROPOD_BORNE_VIRAL_FEVERS = 10;

    #[NameAttribute('Viral infections characterized by skin and mucous membrane lesions')]
    #[RangeAttribute('B00-B09')]
    #[PublicAttribute(true)]
    case SKIN_AND_MUCOUS_MEMBRANE_INFECTIONS = 11;

    #[NameAttribute('Other human herpesviruses')]
    #[RangeAttribute('B10-B10')]
    #[PublicAttribute(true)]
    case OTHER_HUMAN_HERPESVIRUSES = 12;

    #[NameAttribute('Viral hepatitis')]
    #[RangeAttribute('B15-B19')]
    #[PublicAttribute(true)]
    case VIRAL_HEPATITIS = 13;

    #[NameAttribute('Human immunodeficiency virus [HIV] disease')]
    #[RangeAttribute('B20-B20')]
    #[PublicAttribute(true)]
    case HIV_DISEASE = 14;

    #[NameAttribute('Other viral diseases')]
    #[RangeAttribute('B25-B34')]
    #[PublicAttribute(true)]
    case OTHER_VIRAL_DISEASES = 15;

    #[NameAttribute('Mycoses')]
    #[RangeAttribute('B35-B49')]
    #[PublicAttribute(true)]
    case MYCOSES = 16;

    #[NameAttribute('Protozoal diseases')]
    #[RangeAttribute('B50-B64')]
    #[PublicAttribute(true)]
    case PROTOZOAL_DISEASES = 17;

    #[NameAttribute('Helminthiases')]
    #[RangeAttribute('B65-B83')]
    #[PublicAttribute(true)]
    case HELMINTHIASES = 18;

    #[NameAttribute('Pediculosis, acariasis and other infestations')]
    #[RangeAttribute('B85-B89')]
    #[PublicAttribute(true)]
    case INFESTATIONS = 19;

    #[NameAttribute('Sequelae of infectious and parasitic diseases')]
    #[RangeAttribute('B90-B94')]
    #[PublicAttribute(true)]
    case SEQUELAE = 20;

    #[NameAttribute('Bacterial and viral infectious agents')]
    #[RangeAttribute('B95-B97')]
    #[PublicAttribute(true)]
    case INFECTIOUS_AGENTS = 21;

    #[NameAttribute('Other infectious diseases')]
    #[RangeAttribute('B99-B99')]
    #[PublicAttribute(true)]
    case OTHER_INFECTIOUS_DISEASES = 22;
}
