<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Procedure\CPT\SubSpecifics\AnesthesiaType;
use App\Enums\Procedure\CPT\SubSpecifics\EvaluationAndManagementType;
use App\Enums\Procedure\CPT\SubSpecifics\MedicineAndProcedureType;
use App\Enums\Procedure\CPT\SubSpecifics\PathologyAndLaboratoryType;
use App\Enums\Procedure\CPT\SubSpecifics\RadiologyType;
use App\Enums\Procedure\CPT\SubSpecifics\SurgeryType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Anesthesia')]
    #[ChildAttribute(AnesthesiaType::class)]
    #[RangeAttribute('00100', '01999')]
    #[PublicAttribute(true)]
    case ANESTHESIA = 1;

    #[NameAttribute('Surgery')]
    #[ChildAttribute(SurgeryType::class)]
    #[RangeAttribute('10004', '69990')]
    #[PublicAttribute(true)]
    case SURGERY = 2;

    #[NameAttribute('Radiology Procedures')]
    #[ChildAttribute(RadiologyType::class)]
    #[RangeAttribute('70010', '79999')]
    #[PublicAttribute(true)]
    case RADIOLOGY_PROCEDURES = 3;

    #[NameAttribute('Pathology and Laboratory Procedures')]
    #[ChildAttribute(PathologyAndLaboratoryType::class)]
    #[RangeAttribute('80047', '89398')]
    #[PublicAttribute(true)]
    case PATHOLOGY_AND_LABORATORY_PROCEDURES = 4;

    #[NameAttribute('Medicine Services and Procedures')]
    #[ChildAttribute(MedicineAndProcedureType::class)]
    #[RangeAttribute('90281', '99607')]
    #[PublicAttribute(true)]
    case MEDICINE_SERVICES_AND_PROCEDURES = 5;

    #[NameAttribute('Evaluation and Management Services')]
    #[ChildAttribute(EvaluationAndManagementType::class)]
    #[RangeAttribute('99091', '99499')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_MANAGEMENT_SERVICES = 6;

    #[NameAttribute('Multianalyte Assay')]
    #[RangeAttribute('0002M', '0018M')]
    #[PublicAttribute(true)]
    case MULTIANALYTE_ASSAY = 7;
}
