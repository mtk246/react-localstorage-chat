<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Diagnoses\Specifics\CategoryIIType;
use App\Enums\Diagnoses\Specifics\CategoryIType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;

enum DiagnosesType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Category I Codes')]
    #[ChildAttribute(CategoryIType::class)]
    #[PublicAttribute(true)]
    case CATEGORY_I = 1;

    #[NameAttribute('Category II Codes')]
    #[ChildAttribute(CategoryIIType::class)]
    #[PublicAttribute(true)]
    case CATEGORY_II = 2;

}
