<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ScreeningType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // TB Screening
    // Evaluation AND Assessment
    // Patient Status
    // Adolescent Depression, Remission AND Management
    // Head Imaging
    // Pharmacotherapy for OUD
    // Lumbar Spine Associated Conditions
    // Functional STATUS Measurement
    // Lumbar Spine Conditions
    // Limb Pain Assessment
    // Urgent Care Visit
    // Anticoagulation Management
    // Performance Assessment
    // Hospice Services
    // Mobility Status
    // Fall Risk Assessment
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
