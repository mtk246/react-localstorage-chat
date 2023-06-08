<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Procedure\HCPCS\Specifics\AdmMisInvType;
use App\Enums\Procedure\HCPCS\Specifics\AlcoholDrugTreatmentType;
use App\Enums\Procedure\HCPCS\Specifics\DMEMACType;
use App\Enums\Procedure\HCPCS\Specifics\DrugsOtherOralMethodType;
use App\Enums\Procedure\HCPCS\Specifics\DurableMedicalEquipmentType;
use App\Enums\Procedure\HCPCS\Specifics\EnteralParenteralTherapyType;
use App\Enums\Procedure\HCPCS\Specifics\HearingServiceType;
use App\Enums\Procedure\HCPCS\Specifics\MatrixWoundManagementType;
use App\Enums\Procedure\HCPCS\Specifics\MedicalSurgicalSuppliesType;
use App\Enums\Procedure\HCPCS\Specifics\NationalCodeType;
use App\Enums\Procedure\HCPCS\Specifics\OrthoticProceduresType;
use App\Enums\Procedure\HCPCS\Specifics\OutpatientPPSType;
use App\Enums\Procedure\HCPCS\Specifics\PathologyLaboratoryType;
use App\Enums\Procedure\HCPCS\Specifics\ProceduresProfessionalType;
use App\Enums\Procedure\HCPCS\Specifics\ProstheticProcedureType;
use App\Enums\Procedure\HCPCS\Specifics\ScreeningType;
use App\Enums\Procedure\HCPCS\Specifics\TemporaryCodeNoMedicareType;
use App\Enums\Procedure\HCPCS\Specifics\TemporaryCodeType;
use App\Enums\Procedure\HCPCS\Specifics\VisionServiceType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Ambulance and Other Transport Services and Supplies')]
    #[RangeAttribute('A0021', 'A0999')]
    #[PublicAttribute(true)]
    case AMBULANCE_AND_OTHER_TRANSPORT = 1;

    #[NameAttribute('Matrix for Wound Management (Placental, Equine, Synthetic)')]
    #[ChildAttribute(MatrixWoundManagementType::class)]
    #[RangeAttribute('A2001', 'A2021')]
    #[PublicAttribute(true)]
    case MATRIX_FOR_WOUND_MANAGEMENT = 2;

    #[NameAttribute('Skin Substitute Device')]
    #[PublicAttribute(true)]
    #[RangeAttribute('A4100', 'A4100')]
    case SKIN_SUBSTITUTE_DEVICE = 3;

    #[NameAttribute('Medical And Surgical Supplies')]
    #[ChildAttribute(MedicalSurgicalSuppliesType::class)]
    #[RangeAttribute('A4206', 'A8004')]
    #[PublicAttribute(true)]
    case MEDICAL_AND_SURGICAL_SUPPLIES = 4;

    #[NameAttribute('Administrative, Miscellaneous and Investigational')]
    #[ChildAttribute(AdmMisInvType::class)]
    #[RangeAttribute('A9150', 'A9999')]
    #[PublicAttribute(true)]
    case ADMINISTRATIVE_MISCELLANEOUS_INVESTIGATIONAL = 5;

    #[NameAttribute('Enteral and Parenteral Therapy')]
    #[ChildAttribute(EnteralParenteralTherapyType::class)]
    #[RangeAttribute('B4034', 'B9999')]
    #[PublicAttribute(true)]
    case ENTERAL_AND_PARENTAL_THERAPY = 6;

    #[NameAttribute('Other Therapeutic Procedures')]
    #[RangeAttribute('C1052', 'C1062')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_PROCEDURES = 7;

    #[NameAttribute('Outpatient PPS')]
    #[ChildAttribute(OutpatientPPSType::class)]
    #[RangeAttribute('C1713', 'C9899')]
    #[PublicAttribute(true)]
    case OUTPATIENT_PPS = 8;

    #[NameAttribute('Durable Medical Equipment')]
    #[ChildAttribute(DurableMedicalEquipmentType::class)]
    #[RangeAttribute('E0100', 'E8002')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT = 9;

    #[NameAttribute('Procedures / Professional Services')]
    #[ChildAttribute(ProceduresProfessionalType::class)]
    #[RangeAttribute('G0008', 'G9987')]
    #[PublicAttribute(true)]
    case PROCEDURES_PROFESSIONAL_SERVICES = 10;

    #[NameAttribute('Alcohol and Drug Abuse Treatment')]
    #[ChildAttribute(AlcoholDrugTreatmentType::class)]
    #[RangeAttribute('H0001', 'H2037')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_DRUG_ABUSE_TREATMENT = 11;

    #[NameAttribute('Drugs Administered Other than Oral Method')]
    #[ChildAttribute(DrugsOtherOralMethodType::class)]
    #[RangeAttribute('J0120', 'J8999')]
    #[PublicAttribute(true)]
    case DRUGS_ADMINISTERED_OTHER_THAN_ORAL_METHOD = 12;

    #[NameAttribute('Chemotherapy Drugs')]
    #[RangeAttribute('J9000', 'J9999')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_DRUGS = 13;

    #[NameAttribute('Durable medical equipment (DME) Medicare administrative contractors (MACs)')]
    #[ChildAttribute(DMEMACType::class)]
    #[RangeAttribute('K0001', 'K0900')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT_MACS = 14;

    #[NameAttribute('Components, Accessories and Supplies')]
    #[RangeAttribute('K1001', 'K1035')]
    #[PublicAttribute(true)]
    case COMPONENTS_ACCESSORIES_AND_SUPPLIES = 15;

    #[NameAttribute('Orthotic Procedures and services')]
    #[ChildAttribute(OrthoticProceduresType::class)]
    #[RangeAttribute('L0112', 'L4631')]
    #[PublicAttribute(true)]
    case ORTHOTIC_PROCEDURES_AND_SERVICES = 16;

    #[NameAttribute('Prosthetic Procedures')]
    #[ChildAttribute(ProstheticProcedureType::class)]
    #[RangeAttribute('L5000', 'L9900')]
    #[PublicAttribute(true)]
    case PROSTHETIC_PROCEDURES = 17;

    #[NameAttribute('MIPS Value Pathways')]
    #[RangeAttribute('M0001', 'M0005')]
    #[PublicAttribute(true)]
    case MIPS_VALUE_PATHWAYS = 18;

    #[NameAttribute('EOM (Enhancing Oncology Model) Enhanced Services')]
    #[RangeAttribute('M0010', 'M0010')]
    #[PublicAttribute(true)]
    case EOM_ENHANCING_ONCOLOGY_MODEL_ENHANCED_SERVICES = 19;

    #[NameAttribute('Miscellaneous Medical Services')]
    #[RangeAttribute('M0075', 'M0301')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_MEDICAL_SERVICES = 20;

    #[NameAttribute('Screening Procedures')]
    #[ChildAttribute(ScreeningType::class)]
    #[RangeAttribute('M1003', 'M1070')]
    #[PublicAttribute(true)]
    case SCREENING_PROCEDURES = 21;

    #[NameAttribute('Episode of Care')]
    #[RangeAttribute('M1106', 'M1143')]
    #[PublicAttribute(true)]
    case EPISODE_OF_CARE = 22;

    #[NameAttribute('Other Services')]
    #[RangeAttribute('M1146', 'M1210')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 23;

    #[NameAttribute('Pathology and Laboratory Services')]
    #[ChildAttribute(PathologyLaboratoryType::class)]
    #[RangeAttribute('P2028', 'P9615')]
    #[PublicAttribute(true)]
    case PATHOLOGY_AND_LABORATORY_SERVICES = 24;

    #[NameAttribute('Temporary Codes')]
    #[ChildAttribute(TemporaryCodeType::class)]
    #[RangeAttribute('Q0035', 'Q9992')]
    #[PublicAttribute(true)]
    case TEMPORARY_CODES = 25;

    #[NameAttribute('Diagnostic Radiology Services')]
    #[RangeAttribute('R0070', 'R0076')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_RADIOLOGY_SERVICES = 26;

    #[NameAttribute('Temporary National Codes (Non-Medicare)')]
    #[ChildAttribute(TemporaryCodeNoMedicareType::class)]
    #[RangeAttribute('S0012', 'S9999')]
    #[PublicAttribute(true)]
    case TEMPORARY_NATIONAL_CODES_NON_MEDICARE = 27;

    #[NameAttribute('National Codes Established for State Medicaid Agencies')]
    #[ChildAttribute(NationalCodeType::class)]
    #[RangeAttribute('T1000', 'T5999')]
    #[PublicAttribute(true)]
    case NATIONAL_CODES_ESTABLISHED_FOR_STATE_MEDICAID_AGENCIES = 28;

    #[NameAttribute('Coronavirus Diagnostic Panel')]
    #[RangeAttribute('U0001', 'U0005')]
    #[PublicAttribute(true)]
    case CORONAVIRUS_DIAGNOSTIC_PANEL = 29;

    #[NameAttribute('Vision Services')]
    #[ChildAttribute(VisionServiceType::class)]
    #[RangeAttribute('V2020', 'V2799')]
    #[PublicAttribute(true)]
    case VISION_SERVICES = 30;

    #[NameAttribute('Hearing Services')]
    #[ChildAttribute(HearingServiceType::class)]
    #[RangeAttribute('V5008', 'V5364')]
    #[PublicAttribute(true)]
    case HEARING_SERVICES = 31;
}
