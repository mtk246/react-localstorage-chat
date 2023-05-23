<?php

declare(strict_types=1);

namespace App\Enums\HealthProfessional;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum HealthProfessionalType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Medical doctor')]
    #[PublicAttribute(true)]
    case MEDICAL_DOCTOR = 1;

    #[NameAttribute('Nurse practitioners')]
    #[PublicAttribute(true)]
    case NURSE_PRACTITIONERS = 2;

    #[NameAttribute('Physician assistants')]
    #[PublicAttribute(true)]
    case PHYSICIAN_ASSISTANTS = 3;

    #[NameAttribute('Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing')]
    #[PublicAttribute(true)]
    case CERTIFIED_NURSE_SPECIALISTS = 4;

    #[NameAttribute('Certified nurse midwives')]
    #[PublicAttribute(true)]
    case CERTIFIED_NURSE_MIDWIVES = 5;

    #[NameAttribute('Certified registered nurse anesthetists')]
    #[PublicAttribute(true)]
    case CERTIFIED_REGISTERED_NURSE_ANESTHETISTS = 6;

    #[NameAttribute('Clinical social worker')]
    #[PublicAttribute(true)]
    case CLINICAL_SOCIAL_WORKER = 7;

    #[NameAttribute('Physical therapists')]
    #[PublicAttribute(true)]
    case PHYSICAL_THERAPISTS = 8;
}
