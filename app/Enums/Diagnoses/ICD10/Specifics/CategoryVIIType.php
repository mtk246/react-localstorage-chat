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

enum CategoryVIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Disorders of eyelid, lacrimal system and orbit')]
    #[RangeAttribute('H00', 'H05')]
    #[PublicAttribute(true)]
    case EYELID_LACRIMAL_ORBIT = 1;

    #[NameAttribute('Disorders of conjunctiva')]
    #[RangeAttribute('H10', 'H11')]
    #[PublicAttribute(true)]
    case CONJUNCTIVA = 2;

    #[NameAttribute('Disorders of sclera, cornea, iris and ciliary body')]
    #[RangeAttribute('H15', 'H22')]
    #[PublicAttribute(true)]
    case SCLERA_CORNEA_IRIS_CILIARY_BODY = 3;

    #[NameAttribute('Disorders of lens')]
    #[RangeAttribute('H25', 'H28')]
    #[PublicAttribute(true)]
    case LENS = 4;

    #[NameAttribute('Disorders of choroid and retina')]
    #[RangeAttribute('H30', 'H36')]
    #[PublicAttribute(true)]
    case CHOROID_RETINA = 5;

    #[NameAttribute('Glaucoma')]
    #[RangeAttribute('H40', 'H42')]
    #[PublicAttribute(true)]
    case GLAUCOMA = 6;

    #[NameAttribute('Disorders of vitreous body and globe')]
    #[RangeAttribute('H43', 'H44')]
    #[PublicAttribute(true)]
    case VITREOUS_BODY_GLOBE = 7;

    #[NameAttribute('Disorders of optic nerve and visual pathways')]
    #[RangeAttribute('H46', 'H47')]
    #[PublicAttribute(true)]
    case OPTIC_NERVE_VISUAL_PATHWAYS = 8;

    #[NameAttribute('Disorders of ocular muscles, binocular movement, accommodation and refraction')]
    #[RangeAttribute('H49', 'H52')]
    #[PublicAttribute(true)]
    case OCULAR_MUSCLES_BINOCULAR_MOVEMENT = 9;

    #[NameAttribute('Visual disturbances and blindness')]
    #[RangeAttribute('H53', 'H54')]
    #[PublicAttribute(true)]
    case VISUAL_DISTURBANCES_BLINDNESS = 10;

    #[NameAttribute('Other disorders of eye and adnexa')]
    #[RangeAttribute('H55', 'H57')]
    #[PublicAttribute(true)]
    case OTHER_DISORDERS = 11;

    #[NameAttribute('Intraoperative and postprocedural complications and disorders of eye and adnexa, not elsewhere classified')]
    #[RangeAttribute('H59', 'H59')]
    #[PublicAttribute(true)]
    case INTRAOPERATIVE_POSTPROCEDURAL = 12;
}
