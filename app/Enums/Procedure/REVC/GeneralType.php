<?php

declare(strict_types=1);

namespace App\Enums\Procedure\REVC;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Total Charge')]
    #[RangeAttribute('0000', '0009')]
    #[PublicAttribute(true)]
    case TOTAL_CHARGE = 1;

    #[NameAttribute('Payer Code')]
    #[RangeAttribute('0010', '0019')]
    #[PublicAttribute(true)]
    case PAYER_CODE = 2;

    #[NameAttribute('Health Insurance Prospective Payment System (HIPPS)')]
    #[RangeAttribute('0020', '0029')]
    #[PublicAttribute(true)]
    case HIPPS = 3;

    #[NameAttribute('All-inclusive Rate')]
    #[RangeAttribute('0100', '0109')]
    #[PublicAttribute(true)]
    case ALL_INCLUSIVE_RATE = 4;

    #[NameAttribute('Room and Board Private (one bed)')]
    #[RangeAttribute('0110', '0119')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_PRIVATE = 5;

    #[NameAttribute('Room and Board Semi-private (two beds)')]
    #[RangeAttribute('0120', '0129')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_SEMI_PRIVATE = 6;

    #[NameAttribute('Room and Board (3 and 4 beds)')]
    #[RangeAttribute('0130', '0139')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD = 7;

    #[NameAttribute('Room and Board Deluxe Private')]
    #[RangeAttribute('0140', '0149')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_DELUXE_PRIVATE = 8;

    #[NameAttribute('Room and Board Ward')]
    #[RangeAttribute('0150', '0159')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_WARD = 9;

    #[NameAttribute('Other Room and Board')]
    #[RangeAttribute('0160', '0169')]
    #[PublicAttribute(true)]
    case OTHER_ROOM_AND_BOARD = 10;

    #[NameAttribute('Nursery')]
    #[RangeAttribute('0170', '0179')]
    #[PublicAttribute(true)]
    case NURSERY = 11;

    #[NameAttribute('Leave of Absence')]
    #[RangeAttribute('0180', '0189')]
    #[PublicAttribute(true)]
    case LEAVE_OF_ABSENCE = 12;

    #[NameAttribute('Subacute Care')]
    #[RangeAttribute('0190', '0199')]
    #[PublicAttribute(true)]
    case SUBACUTE_CARE = 13;

    #[NameAttribute('Intensive Care Unit')]
    #[RangeAttribute('0200', '0209')]
    #[PublicAttribute(true)]
    case INTENSIVE_CARE_UNIT = 14;

    #[NameAttribute('Coronary Care Unit')]
    #[RangeAttribute('0210', '0219')]
    #[PublicAttribute(true)]
    case CORONARY_CARE_UNIT = 15;

    #[NameAttribute('Special Charges')]
    #[RangeAttribute('0220', '0229')]
    #[PublicAttribute(true)]
    case SPECIAL_CHARGES = 16;

    #[NameAttribute('Incremental Nursing Charge')]
    #[RangeAttribute('0230', '0239')]
    #[PublicAttribute(true)]
    case INCREMENTAL_NURSING_CHARGE = 17;

    #[NameAttribute('All-inclusive Ancillary')]
    #[RangeAttribute('0240', '0249')]
    #[PublicAttribute(true)]
    case ALL_INCLUSIVE_ANCILLARY = 18;

    #[NameAttribute('Pharmacy (Also see 063X, an extension of 250X)')]
    #[RangeAttribute('0250', '0259')]
    #[PublicAttribute(true)]
    case PHARMACY = 19;

    #[NameAttribute('IV Therapy')]
    #[RangeAttribute('0260', '0269')]
    #[PublicAttribute(true)]
    case IV_THERAPY = 20;

    #[NameAttribute('Medical/Surgical Supplies and Devices (Also see 062X, an extension of 027X)')]
    #[RangeAttribute('0270', '0279')]
    #[PublicAttribute(true)]
    case MEDICAL_SURGICAL_SUPPLIES_AND_DEVICES = 21;

    #[NameAttribute('Oncology')]
    #[RangeAttribute('0280', '0289')]
    #[PublicAttribute(true)]
    case ONCOLOGY = 22;

    #[NameAttribute('Durable Medical Equipment (Other than Renal)')]
    #[RangeAttribute('0290', '0299')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT = 23;

    #[NameAttribute('Laboratory')]
    #[RangeAttribute('0300', '0309')]
    #[PublicAttribute(true)]
    case LABORATORY = 24;

    #[NameAttribute('Laboratory Pathology')]
    #[RangeAttribute('0310', '0319')]
    #[PublicAttribute(true)]
    case LABORATORY_PATHOLOGY = 25;

    #[NameAttribute('Radiology Diagnostic')]
    #[RangeAttribute('0320', '0329')]
    #[PublicAttribute(true)]
    case RADIOLOGY_DIAGNOSTIC = 26;

    #[NameAttribute('Radiology Therapeutic and/of Chemotherapy Administration')]
    #[RangeAttribute('0330', '0339')]
    #[PublicAttribute(true)]
    case RADIOLOGY_THERAPEUTIC_AND_OF_CHEMOTHERAPY_ADMINISTRATION = 27;

    #[NameAttribute('Nuclear Medicine')]
    #[RangeAttribute('0340', '0349')]
    #[PublicAttribute(true)]
    case NUCLEAR_MEDICINE = 28;

    #[NameAttribute('CT Scan')]
    #[RangeAttribute('0350', '0359')]
    #[PublicAttribute(true)]
    case CT_SCAN = 29;

    #[NameAttribute('Operating Room Services')]
    #[RangeAttribute('0360', '0369')]
    #[PublicAttribute(true)]
    case OPERATING_ROOM_SERVICES = 30;

    #[NameAttribute('Anesthesia')]
    #[RangeAttribute('0370', '0379')]
    #[PublicAttribute(true)]
    case ANESTHESIA = 31;

    #[NameAttribute('Blood and Blood Products')]
    #[RangeAttribute('0380', '0389')]
    #[PublicAttribute(true)]
    case BLOOD_AND_BLOOD_PRODUCTS = 32;

    #[NameAttribute('Administration, Processing and Storage for Blood and Blood Components')]
    #[RangeAttribute('0390', '0399')]
    #[PublicAttribute(true)]
    case ADMINISTRATION_PROCESSING_AND_STORAGE_FOR_BLOOD_AND_BLOOD_COMPONENTS = 33;

    #[NameAttribute('Other Imaging Services')]
    #[RangeAttribute('0400', '0409')]
    #[PublicAttribute(true)]
    case OTHER_IMAGING_SERVICES = 34;

    #[NameAttribute('Respiratory Services')]
    #[RangeAttribute('0410', '0419')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SERVICES = 35;

    #[NameAttribute('Physical Therapy')]
    #[RangeAttribute('0420', '0429')]
    #[PublicAttribute(true)]
    case PHYSICAL_THERAPY = 36;

    #[NameAttribute('Occupational Therapy')]
    #[RangeAttribute('0430', '0439')]
    #[PublicAttribute(true)]
    case OCCUPATIONAL_THERAPY = 37;

    #[NameAttribute('Speech Therapy Language Pathology')]
    #[RangeAttribute('0440', '0449')]
    #[PublicAttribute(true)]
    case SPEECH_THERAPY_LANGUAGE_PATHOLOGY = 38;

    #[NameAttribute('Emergency Room')]
    #[RangeAttribute('0450', '0459')]
    #[PublicAttribute(true)]
    case EMERGENCY_ROOM = 39;

    #[NameAttribute('Pulmonary Function')]
    #[RangeAttribute('0460', '0469')]
    #[PublicAttribute(true)]
    case PULMONARY_FUNCTION = 40;

    #[NameAttribute('Audiology')]
    #[RangeAttribute('0470', '0479')]
    #[PublicAttribute(true)]
    case AUDIOLOGY = 41;

    #[NameAttribute('Cardiology')]
    #[RangeAttribute('0480', '0489')]
    #[PublicAttribute(true)]
    case CARDIOLOGY = 42;

    #[NameAttribute('Ambulatory Surgical Care')]
    #[RangeAttribute('0490', '0499')]
    #[PublicAttribute(true)]
    case AMBULATORY_SURGICAL_CARE = 43;

    #[NameAttribute('Outpatient Services')]
    #[RangeAttribute('0500', '0509')]
    #[PublicAttribute(true)]
    case OUTPATIENT_SERVICES = 44;

    #[NameAttribute('Clinic')]
    #[RangeAttribute('0510', '0519')]
    #[PublicAttribute(true)]
    case CLINIC = 45;

    #[NameAttribute('Freestanding Clinic')]
    #[RangeAttribute('0520', '0529')]
    #[PublicAttribute(true)]
    case FREESTANDING_CLINIC = 46;

    #[NameAttribute('Osteopathic Services')]
    #[RangeAttribute('0530', '0539')]
    #[PublicAttribute(true)]
    case OSTEOPATHIC_SERVICES = 47;

    #[NameAttribute('Ambulance')]
    #[RangeAttribute('0540', '0549')]
    #[PublicAttribute(true)]
    case AMBULANCE = 48;

    #[NameAttribute('Skilled Nursing')]
    #[RangeAttribute('0550', '0559')]
    #[PublicAttribute(true)]
    case SKILLED_NURSING = 49;

    #[NameAttribute('Home Health Medical Social Services')]
    #[RangeAttribute('0560', '0569')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_MEDICAL_SOCIAL_SERVICES = 50;

    #[NameAttribute('Home Health Aide')]
    #[RangeAttribute('0570', '0579')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_AIDE = 51;

    #[NameAttribute('Home Health Other Visits')]
    #[RangeAttribute('0580', '0589')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_OTHER_VISITS = 52;

    #[NameAttribute('Home Health Units of Service')]
    #[RangeAttribute('0590', '0599')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_UNITS_OF_SERVICE = 53;

    #[NameAttribute('Home Health Oxygen')]
    #[RangeAttribute('0600', '0609')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_OXYGEN = 54;

    #[NameAttribute('Magnetic Resonance Technology (MRT)')]
    #[RangeAttribute('0610', '0619')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_TECHNOLOGY = 55;

    #[NameAttribute('Medical/Surgical Supplies - Extension of 027X')]
    #[RangeAttribute('0620', '0629')]
    #[PublicAttribute(true)]
    case MEDICAL_SURGICAL_SUPPLIES_EXTENSION = 56;

    #[NameAttribute('Pharmacy - Extension of 025X')]
    #[RangeAttribute('0630', '0639')]
    #[PublicAttribute(true)]
    case PHARMACY_EXTENSION = 57;

    #[NameAttribute('Home IV Therapy Services')]
    #[RangeAttribute('0640', '0649')]
    #[PublicAttribute(true)]
    case HOME_IV_THERAPY_SERVICES = 58;

    #[NameAttribute('Hospice Service')]
    #[RangeAttribute('0650', '0659')]
    #[PublicAttribute(true)]
    case HOSPICE_SERVICE = 59;

    #[NameAttribute('Respite Care')]
    #[RangeAttribute('0660', '0669')]
    #[PublicAttribute(true)]
    case RESPITE_CARE = 60;

    #[NameAttribute('Outpatient Special Residence Charges')]
    #[RangeAttribute('0670', '0679')]
    #[PublicAttribute(true)]
    case OUTPATIENT_SPECIAL_RESIDENCE_CHARGES = 61;

    #[NameAttribute('Trauma Response')]
    #[RangeAttribute('0680', '0689')]
    #[PublicAttribute(true)]
    case TRAUMA_RESPONSE = 62;

    #[NameAttribute('Pre-Hospice/Palliative Care Services')]
    #[RangeAttribute('0690', '0699')]
    #[PublicAttribute(true)]
    case PRE_HOSPICE_PALLIATIVE_CARE_SERVICES = 63;

    #[NameAttribute('Cast Room')]
    #[RangeAttribute('0700', '0709')]
    #[PublicAttribute(true)]
    case CAST_ROOM = 64;

    #[NameAttribute('Recovery Room')]
    #[RangeAttribute('0710', '0719')]
    #[PublicAttribute(true)]
    case RECOVERY_ROOM = 65;

    #[NameAttribute('Labor Room/Delivery')]
    #[RangeAttribute('0720', '0729')]
    #[PublicAttribute(true)]
    case LABOR_ROOM_DELIVERY = 66;

    #[NameAttribute('EKG/ECG Electrocardiogram')]
    #[RangeAttribute('0730', '0739')]
    #[PublicAttribute(true)]
    case EKG_ECG_ELECTROCARDIOGRAM = 67;

    #[NameAttribute('EEG Electroencephalogram')]
    #[RangeAttribute('0740', '0749')]
    #[PublicAttribute(true)]
    case EEG_ELECTROENCEPHALOGRAM = 68;

    #[NameAttribute('Gastrointestinal Services')]
    #[RangeAttribute('0750', '0759')]
    #[PublicAttribute(true)]
    case GASTROINTESTINAL_SERVICES = 69;

    #[NameAttribute('Specialty Services')]
    #[RangeAttribute('0760', '0769')]
    #[PublicAttribute(true)]
    case SPECIALTY_SERVICES = 70;

    #[NameAttribute('Preventive Services')]
    #[RangeAttribute('0770', '0779')]
    #[PublicAttribute(true)]
    case PREVENTIVE_SERVICES = 71;

    #[NameAttribute('Telemedicine')]
    #[RangeAttribute('0780', '0789')]
    #[PublicAttribute(true)]
    case TELEMEDICINE = 72;

    #[NameAttribute('Extra-Corporeal Shock Wave Therapy (formerly Lithotripsy)')]
    #[RangeAttribute('0790', '0799')]
    #[PublicAttribute(true)]
    case EXTRA_CORPOREAL_SHOCK_WAVE_THERAPY = 73;

    #[NameAttribute('Inpatient Renal Dialysis')]
    #[RangeAttribute('0800', '0809')]
    #[PublicAttribute(true)]
    case INPATIENT_RENAL_DIALYSIS = 74;

    #[NameAttribute('Acquisition of Body Components')]
    #[RangeAttribute('0810', '0819')]
    #[PublicAttribute(true)]
    case ACQUISITION_OF_BODY_COMPONENTS = 75;

    #[NameAttribute('Hemodialysis - Outpatient or Home')]
    #[RangeAttribute('0820', '0829')]
    #[PublicAttribute(true)]
    case HEMODIALYSIS = 76;

    #[NameAttribute('Peritoneal Dialysis - Outpatient or Home')]
    #[RangeAttribute('0830', '0839')]
    #[PublicAttribute(true)]
    case PERITONEAL_DIALYSIS = 77;

    #[NameAttribute('Continuous Ambulatory Peritoneal Dialysis (CAPD)- Outpatient or Home')]
    #[RangeAttribute('0840', '0849')]
    #[PublicAttribute(true)]
    case CONTINUOUS_AMBULATORY_PERITONEAL_DIALYSIS = 78;

    #[NameAttribute('Continuous Cycling Peritoneal Dialysis (CCPD) - Outpatient or Home')]
    #[RangeAttribute('0850', '0859')]
    #[PublicAttribute(true)]
    case CONTINUOUS_CYCLING_PERITONEAL_DIALYSIS = 79;

    #[NameAttribute('Magnetoencephalography')]
    #[RangeAttribute('0860', '0869')]
    #[PublicAttribute(true)]
    case MAGNETOENCEPHALOGRAPHY = 80;

    #[NameAttribute('Cell/Gene Therapy')]
    #[RangeAttribute('0870', '0879')]
    #[PublicAttribute(true)]
    case CELL_GENE_THERAPY = 81;

    #[NameAttribute('Miscellaneous Dialysis')]
    #[RangeAttribute('0880', '0889')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DIALYSIS = 82;

    #[NameAttribute('Pharmacy - Extension of 025X and 063X')]
    #[RangeAttribute('0890', '0899')]
    #[PublicAttribute(true)]
    case PHARMACY_EXTENSION_025X_063X = 83;

    #[NameAttribute('Behavioral Health Treatments/Services (also see 091X, and extension of 090X)')]
    #[RangeAttribute('0900', '0909')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_TREATMENTS_SERVICES = 84;

    #[NameAttribute('Behavioral Health Treatments/Services - Extension of 090X')]
    #[RangeAttribute('0910', '0919')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_TREATMENTS_SERVICES_EXTENSION = 85;

    #[NameAttribute('Other Diagnostic Services')]
    #[RangeAttribute('0920', '0929')]
    #[PublicAttribute(true)]
    case OTHER_DIAGNOSTIC_SERVICES = 86;

    #[NameAttribute('Medical Rehabilitation Day Program')]
    #[RangeAttribute('0930', '0939')]
    #[PublicAttribute(true)]
    case MEDICAL_REHABILITATION_DAY_PROGRAM = 87;

    #[NameAttribute('Other Therapeutic Services - See also 095X')]
    #[RangeAttribute('0940', '0949')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES = 88;

    #[NameAttribute('Other Therapeutic Services (Extension of 094X)')]
    #[RangeAttribute('0950', '0959')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES_EXTENSION = 89;

    #[NameAttribute('Professional Fees')]
    #[RangeAttribute('0960', '0969')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES = 90;

    #[NameAttribute('Professional Fees (Extension of 096X)')]
    #[RangeAttribute('0970', '0979')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES_EXTENSION = 91;

    #[NameAttribute('Professional Fees (Extension of 096X and 097X)')]
    #[RangeAttribute('0980', '0989')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES_EXTENSION_096X_097X = 92;

    #[NameAttribute('Patient Convenience Items')]
    #[RangeAttribute('0990', '0999')]
    #[PublicAttribute(true)]
    case PATIENT_CONVENIENCE_ITEMS = 93;

    #[NameAttribute('Behavioral Health Accommodations')]
    #[RangeAttribute('1000', '1009')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_ACCOMMODATIONS = 94;

    #[NameAttribute('Alternative Therapy Services')]
    #[RangeAttribute('2100', '2109')]
    #[PublicAttribute(true)]
    case ALTERNATIVE_THERAPY_SERVICES = 95;

    #[NameAttribute('Adult Care')]
    #[RangeAttribute('3100', '3109')]
    #[PublicAttribute(true)]
    case ADULT_CARE = 96;
}
