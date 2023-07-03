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

enum CategoryXType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute("Acute upper respiratory infections")]
    #[RangeAttribute("J00-J06")]
    #[PublicAttribute(true)]
    case ACUTE_UPPER_RESPIRATORY_INFECTIONS = 1;

    #[NameAttribute("Influenza and pneumonia")]
    #[RangeAttribute("J09-J18")]
    #[PublicAttribute(true)]
    case INFLUENZA_AND_PNEUMONIA = 2;

    #[NameAttribute("Other acute lower respiratory infections")]
    #[RangeAttribute("J20-J22")]
    #[PublicAttribute(true)]
    case OTHER_ACUTE_LOWER_RESPIRATORY_INFECTIONS = 3;

    #[NameAttribute("Other diseases of upper respiratory tract")]
    #[RangeAttribute("J30-J39")]
    #[PublicAttribute(true)]
    case OTHER_DISEASES_OF_UPPER_RESPIRATORY_TRACT = 4;

    #[NameAttribute("Chronic lower respiratory diseases")]
    #[RangeAttribute("J40-J47")]
    #[PublicAttribute(true)]
    case CHRONIC_LOWER_RESPIRATORY_DISEASES = 5;

    #[NameAttribute("Lung diseases due to external agents")]
    #[RangeAttribute("J60-J70")]
    #[PublicAttribute(true)]
    case LUNG_DISEASES_DUE_TO_EXTERNAL_AGENTS = 6;

    #[NameAttribute("Other respiratory diseases principally affecting the interstitium")]
    #[RangeAttribute("J80-J84")]
    #[PublicAttribute(true)]
    case OTHER_RESPIRATORY_DISEASES_PRINCIPALLY_AFFECTING_THE_INTERSTITIUM = 7;

    #[NameAttribute("Suppurative and necrotic conditions of the lower respiratory tract")]
    #[RangeAttribute("J85-J86")]
    #[PublicAttribute(true)]
    case SUPPURATIVE_AND_NECROTIC_CONDITIONS_OF_LOWER_RESPIRATORY_TRACT = 8;

    #[NameAttribute("Other diseases of the pleura")]
    #[RangeAttribute("J90-J94")]
    #[PublicAttribute(true)]
    case OTHER_DISEASES_OF_PLEURA = 9;

    #[NameAttribute("Intraoperative and postprocedural complications and disorders of respiratory system, not elsewhere classified")]
    #[RangeAttribute("J95-J95")]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_AND_POSTPROCEDURAL_COMPLICATIONS_OF_RESPIRATORY_SYSTEM = 10;

    #[NameAttribute("Other diseases of the respiratory system")]
    #[RangeAttribute("J96-J99")]
    #[PublicAttribute(true)]
    case OTHER_DISEASES_OF_RESPIRATORY_SYSTEM = 11;
}
