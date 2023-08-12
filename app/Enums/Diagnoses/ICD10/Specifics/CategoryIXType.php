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

enum CategoryIXType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Acute rheumatic fever')]
    #[RangeAttribute('I00', 'I02')]
    #[PublicAttribute(true)]
    case ACUTE_RHEUMATIC_FEVER = 1;

    #[NameAttribute('Chronic rheumatic heart diseases')]
    #[RangeAttribute('I05', 'I09')]
    #[PublicAttribute(true)]
    case CHRONIC_RHEUMATIC_HEART_DISEASES = 2;

    #[NameAttribute('Hypertensive diseases')]
    #[RangeAttribute('I10', 'I16')]
    #[PublicAttribute(true)]
    case HYPERTENSIVE_DISEASES = 3;

    #[NameAttribute('Ischemic heart diseases')]
    #[RangeAttribute('I20', 'I25')]
    #[PublicAttribute(true)]
    case ISCHEMIC_HEART_DISEASES = 4;

    #[NameAttribute('Pulmonary heart disease and diseases of pulmonary circulation')]
    #[RangeAttribute('I26', 'I28')]
    #[PublicAttribute(true)]
    case PULMONARY_HEART_DISEASE = 5;

    #[NameAttribute('Other forms of heart disease')]
    #[RangeAttribute('I30', 'I5A')]
    #[PublicAttribute(true)]
    case OTHER_FORMS_OF_HEART_DISEASE = 6;

    #[NameAttribute('Cerebrovascular diseases')]
    #[RangeAttribute('I60', 'I69')]
    #[PublicAttribute(true)]
    case CEREBROVASCULAR_DISEASES = 7;

    #[NameAttribute('Diseases of arteries, arterioles and capillaries')]
    #[RangeAttribute('I70', 'I79')]
    #[PublicAttribute(true)]
    case DISEASES_OF_ARTERIES = 8;

    #[NameAttribute('Diseases of veins, lymphatic vessels and lymph nodes, not elsewhere classified')]
    #[RangeAttribute('I80', 'I89')]
    #[PublicAttribute(true)]
    case DISEASES_OF_VEINS = 9;

    #[NameAttribute('Other and unspecified disorders of the circulatory system')]
    #[RangeAttribute('I95', 'I99')]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS = 10;
}
