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

enum CategoryXIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute("Infections of the skin and subcutaneous tissue")]
    #[RangeAttribute("L00-L08")]
    #[PublicAttribute(true)]
    case INFECTIONS_OF_THE_SKIN_AND_SUBCUTANEOUS_TISSUE = 1;

    #[NameAttribute("Bullous disorders")]
    #[RangeAttribute("L10-L14")]
    #[PublicAttribute(true)]
    case BULLOUS_DISORDERS = 2;

    #[NameAttribute("Dermatitis and eczema")]
    #[RangeAttribute("L20-L30")]
    #[PublicAttribute(true)]
    case DERMATITIS_AND_ECZEMA = 3;

    #[NameAttribute("Papulosquamous disorders")]
    #[RangeAttribute("L40-L45")]
    #[PublicAttribute(true)]
    case PAPULOSQUAMOUS_DISORDERS = 4;

    #[NameAttribute("Urticaria and erythema")]
    #[RangeAttribute("L49-L54")]
    #[PublicAttribute(true)]
    case URTICARIA_AND_ERYTHEMA = 5;

    #[NameAttribute("Radiation-related disorders of the skin and subcutaneous tissue")]
    #[RangeAttribute("L55-L59")]
    #[PublicAttribute(true)]
    case RADIATION_RELATED_DISORDERS_OF_THE_SKIN_AND_SUBCUTANEOUS_TISSUE = 6;

    #[NameAttribute("Disorders of skin appendages")]
    #[RangeAttribute("L60-L75")]
    #[PublicAttribute(true)]
    case DISORDERS_OF_SKIN_APPENDAGES = 7;

    #[NameAttribute("Intraoperative and postprocedural complications of skin and subcutaneous tissue")]
    #[RangeAttribute("L76-L76")]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_AND_POSTPROCEDURAL_COMPLICATIONS_OF_SKIN_AND_SUBCUTANEOUS_TISSUE = 8;

    #[NameAttribute("Other disorders of the skin and subcutaneous tissue")]
    #[RangeAttribute("L80-L99")]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS_OF_THE_SKIN_AND_SUBCUTANEOUS_TISSUE = 9;
}
