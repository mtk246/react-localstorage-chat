<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HIPPS;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements TypeInterface, HasChildInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;

    #[NameAttribute('Ambulance and Other Transport Services and Supplies')]
    #[PublicAttribute(true)]
    case AMBULANCE_AND_OTHER_TRANSPORT = 1;

    #[NameAttribute('Matrix for Wound Management (Placental, Equine, Synthetic)')]
    #[PublicAttribute(true)]
    case MATRIX_FOR_WOUND_MANAGEMENT = 2;

    #[NameAttribute('Skin Substitute Device')]
    #[PublicAttribute(true)]
    case SKIN_SUBSTITUTE_DEVICE = 3;
}
