<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD09;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ColorTypeInterface;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;
use App\Enums\Traits\HasRangeAttribute;

enum GeneralType: int implements ProcedureClassificationInterface, ColorTypeInterface
{
    use HasChildAttribute;
    use HasRangeAttribute;
    use HasColorAttributes;

    #[ColorAttribute('#FFFFFF')]
    #[NameAttribute('Other')]
    #[RangeAttribute('000', '000')]
    #[PublicAttribute(true)]
    case OTHER = 1;
}
