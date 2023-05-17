<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS;

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

    #[NameAttribute('Medical And Surgical Supplies')]
    #[PublicAttribute(true)]
    case MEDICAL_AND_SURGICAL_SUPPLIES = 4;

    #[NameAttribute('Administrative, Miscellaneous and Investigational')]
    #[PublicAttribute(true)]
    case ADMINISTRATIVE_MISCELLANEOUS_AND_INVESTIGATIONAL = 5;

    #[NameAttribute('Enteral and Parenteral Therapy')]
    #[PublicAttribute(true)]
    case ENTERAL_AND_PARENTERAL_THERAPY = 6;

    #[NameAttribute('Other Therapeutic Procedures')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_PROCEDURES = 7;

    #[NameAttribute('Outpatient PPS')]
    #[PublicAttribute(true)]
    case OUTPATIENT_PPS = 8;

    #[NameAttribute('Durable Medical Equipment')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT = 9;

    #[NameAttribute('Procedures / Professional Services')]
    #[PublicAttribute(true)]
    case PROCEDURES_AND_PROFESSIONAL_SERVICES = 10;

    #[NameAttribute('Alcohol and Drug Abuse Treatment')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_DRUG_ABUSE_TREATMENT = 11;

    #[NameAttribute('Drugs Administered Other than Oral Method')]
    #[PublicAttribute(true)]
    case DRUGS_ADMINISTERED_OTHER_THAN_ORAL_METHOD = 12;

    #[NameAttribute('Chemotherapy Drugs')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_DRUGS = 13;

    #[NameAttribute('Durable medical equipment (DME) Medicare administrative contractors (MACs)')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT_MACS = 14;

    #[NameAttribute('Components, Accessories and Supplies')]
    #[PublicAttribute(true)]
    case COMPONENTS = 15;

    #[NameAttribute('Orthotic Procedures and services')]
    #[PublicAttribute(true)]
    case ORTHOTIC_PROCEDURES = 16;

    #[NameAttribute('Prosthetic Procedures')]
    #[PublicAttribute(true)]
    case PROSTHETIC_PROCEDURES = 17;

    #[NameAttribute('MIPS Value Pathways')]
    #[PublicAttribute(true)]
    case MIPS_VALUE_PATHWAYS = 18;

    #[NameAttribute('EOM (Enhancing Oncology Model) Enhanced Services')]
    #[PublicAttribute(true)]
    case EOM_ENHANCED_SERVICES = 19;

    #[NameAttribute('Miscellaneous Medical Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_MEDICAL_SERVICES = 20;

    #[NameAttribute('Screening Procedures')]
    #[PublicAttribute(true)]
    case SCREENING_PROCEDURES = 21;

    #[NameAttribute('Episode of Care')]
    #[PublicAttribute(true)]
    case EPISODE_OF_CARE = 22;

    #[NameAttribute('Other Services')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 23;

    #[NameAttribute('Pathology and Laboratory Services')]
    #[PublicAttribute(true)]
    case PATHOLOGY_AND_LABORATORY_SERVICES = 24;

    #[NameAttribute('Temporary Codes')]
    #[PublicAttribute(true)]
    case TEMPORARY_CODES = 25;

    #[NameAttribute('Diagnostic Radiology Services')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_RADIOLOGY_SERVICES = 26;

    #[NameAttribute('Temporary National Codes (Non-Medicare)')]
    #[PublicAttribute(true)]
    case TEMPORARY_NATIONAL_CODES = 27;

    #[NameAttribute('National Codes Established for State Medicaid Agencies')]
    #[PublicAttribute(true)]
    case NATIONAL_CODES_ESTABLISHED_FOR_STATE_MEDICAID_AGENCIES = 28;

    #[NameAttribute('Coronavirus Diagnostic Panel')]
    #[PublicAttribute(true)]
    case CORONAVIRUS_DIAGNOSTIC_PANEL = 29;

    #[NameAttribute('Vision Services')]
    #[PublicAttribute(true)]
    case VISION_SERVICES = 30;

    #[NameAttribute('Hearing Services')]
    #[PublicAttribute(true)]
    case HEARING_SERVICES = 31;
}
