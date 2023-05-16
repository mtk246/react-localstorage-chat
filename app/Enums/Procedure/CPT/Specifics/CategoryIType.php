<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Procedure\CPT\SubSpecifics\AnesthesiaType;
use App\Enums\Procedure\CPT\SubSpecifics\EvaluationAndManagementType;
use App\Enums\Procedure\CPT\SubSpecifics\MedicineAndProcedureType;
use App\Enums\Procedure\CPT\SubSpecifics\PathologyAndLaboratoryType;
use App\Enums\Procedure\CPT\SubSpecifics\RadiologyType;
use App\Enums\Procedure\CPT\SubSpecifics\SurgeryType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIType: int implements TypeInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;

    #[NameAttribute('Anesthesia')]
    #[ChildAttribute(AnesthesiaType::class)]
    #[PublicAttribute(true)]
    case ANESTHESIA = 1;

    #[NameAttribute('Surgery')]
    #[ChildAttribute(SurgeryType::class)]
    #[PublicAttribute(true)]
    case SURGERY = 2;

    #[NameAttribute('Radiology Procedures')]
    #[ChildAttribute(RadiologyType::class)]
    #[PublicAttribute(true)]
    case RADIOLOGY_PROCEDURES = 3;

    #[NameAttribute('Pathology and Laboratory Procedures')]
    #[ChildAttribute(PathologyAndLaboratoryType::class)]
    #[PublicAttribute(true)]
    case PATHOLOGY_AND_LABORATORY_PROCEDURES = 4;

    #[NameAttribute('Medicine Services and Procedures')]
    #[ChildAttribute(MedicineAndProcedureType::class)]
    #[PublicAttribute(true)]
    case MEDICINE_SERVICES_AND_PROCEDURES = 5;

    #[NameAttribute('Evaluation and Management Services')]
    #[ChildAttribute(EvaluationAndManagementType::class)]
    #[PublicAttribute(true)]
    case EVALUATION_AND_MANAGEMENT_SERVICES = 6;

    #[NameAttribute('Multianalyte Assay')]
    #[PublicAttribute(true)]
    case MULTIANALYTE_ASSAY = 7;
}
