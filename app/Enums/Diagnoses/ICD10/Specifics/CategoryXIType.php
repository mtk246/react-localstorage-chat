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

enum CategoryXIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Diseases of oral cavity and salivary glands')]
    #[RangeAttribute('K00', 'K14')]
    #[PublicAttribute(true)]
    case ORAL_CAVITY_AND_SALIVARY_GLANDS = 1;

    #[NameAttribute('Diseases of esophagus, stomach and duodenum')]
    #[RangeAttribute('K20', 'K31')]
    #[PublicAttribute(true)]
    case ESOPHAGUS_STOMACH_DUODENUM = 2;

    #[NameAttribute('Diseases of appendix')]
    #[RangeAttribute('K35', 'K38')]
    #[PublicAttribute(true)]
    case APPENDIX = 3;

    #[NameAttribute('Hernia')]
    #[RangeAttribute('K40', 'K46')]
    #[PublicAttribute(true)]
    case HERNIA = 4;

    #[NameAttribute('Noninfective enteritis and colitis')]
    #[RangeAttribute('K50', 'K52')]
    #[PublicAttribute(true)]
    case ENTERITIS_COLITIS = 5;

    #[NameAttribute('Other diseases of intestines')]
    #[RangeAttribute('K55', 'K64')]
    #[PublicAttribute(true)]
    case OTHER_INTESTINES = 6;

    #[NameAttribute('Diseases of peritoneum and retroperitoneum')]
    #[RangeAttribute('K65', 'K68')]
    #[PublicAttribute(true)]
    case PERITONEUM_RETROPERITONEUM = 7;

    #[NameAttribute('Diseases of liver')]
    #[RangeAttribute('K70', 'K77')]
    #[PublicAttribute(true)]
    case LIVER = 8;

    #[NameAttribute('Disorders of gallbladder, biliary tract and pancreas')]
    #[RangeAttribute('K80', 'K87')]
    #[PublicAttribute(true)]
    case GALLBLADDER_BILIARY_TRACT_PANCREAS = 9;

    #[NameAttribute('Other diseases of the digestive system')]
    #[RangeAttribute('K90', 'K95')]
    #[PublicAttribute(true)]
    case OTHER_DIGESTIVE_SYSTEM = 10;
}
