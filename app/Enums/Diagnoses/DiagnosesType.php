<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Diagnoses\ICD09\GeneralType as ICD09GeneralType;
use App\Enums\Diagnoses\ICD10\GeneralType as ICD10GeneralType;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum DiagnosesType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('ICD-09')]
    #[ChildAttribute(ICD09GeneralType::class)]
    #[PublicAttribute(true)]
    case ICD09 = 1;

    #[NameAttribute('ICD-10')]
    #[ChildAttribute(ICD10GeneralType::class)]
    #[PublicAttribute(true)]
    case ICD10 = 2;
}
