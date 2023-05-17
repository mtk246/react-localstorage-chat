<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum EvaluationAndManagementType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Office or Other Outpatient Services')]
    #[PublicAttribute(true)]
    case OFFICE_OR_OUTPATIENT = 1;

    #[NameAttribute('Hospital Inpatient Services')]
    #[PublicAttribute(true)]
    case HOSPITAL_INPATIENT = 2;

    #[NameAttribute('Consultation Services')]
    #[PublicAttribute(true)]
    case CONSULTATION = 3;

    #[NameAttribute('Emergency Department Services')]
    #[PublicAttribute(true)]
    case EMERGENCY_DEPARTMENT = 4;

    #[NameAttribute('Critical Care Services')]
    #[PublicAttribute(true)]
    case CRITICAL_CARE = 5;

    #[NameAttribute('Nursing Facility Services')]
    #[PublicAttribute(true)]
    case NURSING_FACILITY = 6;

    #[NameAttribute('Home Services')]
    #[PublicAttribute(true)]
    case HOME = 7;

    #[NameAttribute('Prolonged Services')]
    #[PublicAttribute(true)]
    case PROLONGED = 8;

    #[NameAttribute('Case Management Services')]
    #[PublicAttribute(true)]
    case CASE_MANAGEMENT = 9;

    #[NameAttribute('Care Plan Oversight Services')]
    #[PublicAttribute(true)]
    case CARE_PLAN_OVERSIGHT = 10;

    #[NameAttribute('Preventive Medicine Services')]
    #[PublicAttribute(true)]
    case PREVENTIVE_MEDICINE = 11;

    #[NameAttribute('Non-Face-to-Face Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case NON_PRECENCIAL_EVALUATION = 12;

    #[NameAttribute('Special Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case SPECIAL_EVALUATION = 13;

    #[NameAttribute('Newborn Care Services')]
    #[PublicAttribute(true)]
    case NEWBORN_CARE = 14;

    #[NameAttribute('Delivery/Birthing Room Attendance and Resuscitation Services')]
    #[PublicAttribute(true)]
    case DELIVERY_ATTENDANCE = 15;

    #[NameAttribute('Inpatient Neonatal Intensive Care Services and Pediatric and Neonatal Critical Care Services')]
    #[PublicAttribute(true)]
    case INPATIENT_NEONATAL = 16;

    #[NameAttribute('Cognitive Assessment and Care Plan Services')]
    #[PublicAttribute(true)]
    case COGNITIVE_ASSESSMENT = 17;

    #[NameAttribute('General Behavioral Health Integration Care Management')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH = 18;

    #[NameAttribute('Care Management Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case CARE_MANAGEMENT = 19;

    #[NameAttribute('Psychiatric Collaborative Care Management Services')]
    #[PublicAttribute(true)]
    case PSYCHIATRIC_COLLABORATIVE = 20;

    #[NameAttribute('Transitional Care Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case TRANSITIONAL_CARE_EVALUATION = 21;

    #[NameAttribute('Advance Care Planning Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case ADVANCE_CARE_PLANNING = 22;

    #[NameAttribute('Other Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case OTHER_EVALUATION = 23;
}
