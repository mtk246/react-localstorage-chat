<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum EvaluationAndManagementType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('Office or Other Outpatient Services')]
    #[RangeAttribute('99202', '99215')]
    #[PublicAttribute(true)]
    case OFFICE_OR_OUTPATIENT = 1;

    #[NameAttribute('Hospital Inpatient Services')]
    #[RangeAttribute('99221', '99239')]
    #[PublicAttribute(true)]
    case HOSPITAL_INPATIENT = 2;

    #[NameAttribute('Consultation Services')]
    #[RangeAttribute('99242', '99255')]
    #[PublicAttribute(true)]
    case CONSULTATION = 3;

    #[NameAttribute('Emergency Department Services')]
    #[RangeAttribute('99281', '99288')]
    #[PublicAttribute(true)]
    case EMERGENCY_DEPARTMENT = 4;

    #[NameAttribute('Critical Care Services')]
    #[RangeAttribute('99291', '99292')]
    #[PublicAttribute(true)]
    case CRITICAL_CARE = 5;

    #[NameAttribute('Nursing Facility Services')]
    #[RangeAttribute('99304', '99316')]
    #[PublicAttribute(true)]
    case NURSING_FACILITY = 6;

    #[NameAttribute('Home Services')]
    #[RangeAttribute('99341', '99350')]
    #[PublicAttribute(true)]
    case HOME = 7;

    #[NameAttribute('Prolonged Services')]
    #[RangeAttribute('99358', '99418')]
    #[PublicAttribute(true)]
    case PROLONGED = 8;

    #[NameAttribute('Case Management Services')]
    #[RangeAttribute('99366', '99368')]
    #[PublicAttribute(true)]
    case CASE_MANAGEMENT = 9;

    #[NameAttribute('Care Plan Oversight Services')]
    #[RangeAttribute('99374', '99380')]
    #[PublicAttribute(true)]
    case CARE_PLAN_OVERSIGHT = 10;

    #[NameAttribute('Preventive Medicine Services')]
    #[RangeAttribute('99381', '99429')]
    #[PublicAttribute(true)]
    case PREVENTIVE_MEDICINE = 11;

    #[NameAttribute('Non-Face-to-Face Evaluation and Management Services')]
    #[RangeAttribute('99437', '99458')]
    #[PublicAttribute(true)]
    case NON_PRECENCIAL_EVALUATION = 12;

    #[NameAttribute('Special Evaluation and Management Services')]
    #[RangeAttribute('99450', '99458')]
    #[PublicAttribute(true)]
    case SPECIAL_EVALUATION = 13;

    #[NameAttribute('Newborn Care Services')]
    #[RangeAttribute('99460', '99463')]
    #[PublicAttribute(true)]
    case NEWBORN_CARE = 14;

    #[NameAttribute('Delivery/Birthing Room Attendance and Resuscitation Services')]
    #[RangeAttribute('99464', '99465')]
    #[PublicAttribute(true)]
    case DELIVERY_ATTENDANCE = 15;

    #[NameAttribute('Inpatient Neonatal Intensive Care Services and Pediatric and Neonatal Critical Care Services')]
    #[RangeAttribute('99466', '99480')]
    #[PublicAttribute(true)]
    case INPATIENT_NEONATAL = 16;

    #[NameAttribute('Cognitive Assessment and Care Plan Services')]
    #[RangeAttribute('99483', '99486')]
    #[PublicAttribute(true)]
    case COGNITIVE_ASSESSMENT = 17;

    #[NameAttribute('General Behavioral Health Integration Care Management')]
    #[RangeAttribute('99484', '99484')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH = 18;

    #[NameAttribute('Care Management Evaluation and Management Services')]
    #[RangeAttribute('99487', '99491')]
    #[PublicAttribute(true)]
    case CARE_MANAGEMENT = 19;

    #[NameAttribute('Psychiatric Collaborative Care Management Services')]
    #[RangeAttribute('99492', '99494')]
    #[PublicAttribute(true)]
    case PSYCHIATRIC_COLLABORATIVE = 20;

    #[NameAttribute('Transitional Care Evaluation and Management Services')]
    #[RangeAttribute('99495', '99496')]
    #[PublicAttribute(true)]
    case TRANSITIONAL_CARE_EVALUATION = 21;

    #[NameAttribute('Advance Care Planning Evaluation and Management Services')]
    #[RangeAttribute('99497', '99498')]
    #[PublicAttribute(true)]
    case ADVANCE_CARE_PLANNING = 22;

    #[NameAttribute('Other Evaluation and Management Services')]
    #[RangeAttribute('99499', '99499')]
    #[PublicAttribute(true)]
    case OTHER_EVALUATION = 23;
}
