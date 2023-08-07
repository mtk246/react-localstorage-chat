<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HIPPS;

use App\Enums\Attributes\CodeAttribute;
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

    #[NameAttribute('Total Charge')]
    #[CodeAttribute('0001')]
    #[PublicAttribute(true)]
    case TOTAL_CHARGE = 1;

    #[NameAttribute('Payer Code')]
    #[CodeAttribute('001X')]
    #[PublicAttribute(true)]
    case PAYER_CODE = 2;

    #[NameAttribute('Health Insurance Prospective Payment System (HIPPS)')]
    #[CodeAttribute('002X')]
    #[PublicAttribute(true)]
    case HIPPS = 3;

    #[NameAttribute('All-inclusive Rate')]
    #[CodeAttribute('010X')]
    #[PublicAttribute(true)]
    case ALL_INCLUSIVE_RATE = 4;

    #[NameAttribute('Room and Board Private (one bed)')]
    #[CodeAttribute('011X')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_PRIVATE = 5;

    #[NameAttribute('Room and Board Semi-private (two beds)')]
    #[CodeAttribute('012X')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_SEMI_PRIVATE = 6;

    #[NameAttribute('Room and Board (3 and 4 beds)')]
    #[CodeAttribute('013X')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD = 7;

    #[NameAttribute('Room and Board Deluxe Private')]
    #[CodeAttribute('014X')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_DELUXE_PRIVATE = 8;

    #[NameAttribute('Room and Board Ward')]
    #[CodeAttribute('015X')]
    #[PublicAttribute(true)]
    case ROOM_AND_BOARD_WARD = 9;

    #[NameAttribute('Other Room and Board')]
    #[CodeAttribute('016X')]
    #[PublicAttribute(true)]
    case OTHER_ROOM_AND_BOARD = 10;

    #[NameAttribute('Nursery')]
    #[CodeAttribute('017X')]
    #[PublicAttribute(true)]
    case NURSERY = 11;

    #[NameAttribute('Leave of Absence')]
    #[CodeAttribute('018X')]
    #[PublicAttribute(true)]
    case LEAVE_OF_ABSENCE = 12;

    #[NameAttribute('Subacute Care')]
    #[CodeAttribute('019X')]
    #[PublicAttribute(true)]
    case SUBACUTE_CARE = 13;

    #[NameAttribute('Intensive Care Unit')]
    #[CodeAttribute('020X')]
    #[PublicAttribute(true)]
    case INTENSIVE_CARE_UNIT = 14;

    #[NameAttribute('Coronary Care Unit')]
    #[CodeAttribute('021X')]
    #[PublicAttribute(true)]
    case CORONARY_CARE_UNIT = 15;

    #[NameAttribute('Special Charges')]
    #[CodeAttribute('022X')]
    #[PublicAttribute(true)]
    case SPECIAL_CHARGES = 16;

    #[NameAttribute('Incremental Nursing Charge')]
    #[CodeAttribute('023X')]
    #[PublicAttribute(true)]
    case INCREMENTAL_NURSING_CHARGE = 17;

    #[NameAttribute('All-inclusive Ancillary')]
    #[CodeAttribute('024X')]
    #[PublicAttribute(true)]
    case ALL_INCLUSIVE_ANCILLARY = 18;

    #[NameAttribute('Pharmacy (Also see 063X, an extension of 250X)')]
    #[CodeAttribute('025X')]
    #[PublicAttribute(true)]
    case PHARMACY = 19;

    #[NameAttribute('IV Therapy')]
    #[CodeAttribute('026X')]
    #[PublicAttribute(true)]
    case IV_THERAPY = 20;

    #[NameAttribute('Medical/Surgical Supplies and Devices (Also see 062X, an extension of 027X)')]
    #[CodeAttribute('027X')]
    #[PublicAttribute(true)]
    case MEDICAL_SURGICAL_SUPPLIES_AND_DEVICES = 21;

    #[NameAttribute('Oncology')]
    #[CodeAttribute('028X')]
    #[PublicAttribute(true)]
    case ONCOLOGY = 22;

    #[NameAttribute('Durable Medical Equipment (Other than Renal)')]
    #[CodeAttribute('029X')]
    #[PublicAttribute(true)]
    case DURABLE_MEDICAL_EQUIPMENT = 23;

    #[NameAttribute('Laboratory')]
    #[CodeAttribute('030X')]
    #[PublicAttribute(true)]
    case LABORATORY = 24;

    #[NameAttribute('Laboratory Pathology')]
    #[CodeAttribute('031X')]
    #[PublicAttribute(true)]
    case LABORATORY_PATHOLOGY = 25;

    #[NameAttribute('Radiology Diagnostic')]
    #[CodeAttribute('032X')]
    #[PublicAttribute(true)]
    case RADIOLOGY_DIAGNOSTIC = 26;

    #[NameAttribute('Radiology Therapeutic and/of Chemotherapy Administration')]
    #[CodeAttribute('033X')]
    #[PublicAttribute(true)]
    case RADIOLOGY_THERAPEUTIC_AND_OF_CHEMOTHERAPY_ADMINISTRATION = 27;

    #[NameAttribute('Nuclear Medicine')]
    #[CodeAttribute('034X')]
    #[PublicAttribute(true)]
    case NUCLEAR_MEDICINE = 28;

    #[NameAttribute('CT Scan')]
    #[CodeAttribute('035X')]
    #[PublicAttribute(true)]
    case CT_SCAN = 29;

    #[NameAttribute('Operating Room Services')]
    #[CodeAttribute('036X')]
    #[PublicAttribute(true)]
    case OPERATING_ROOM_SERVICES = 30;

    #[NameAttribute('Anesthesia')]
    #[CodeAttribute('037X')]
    #[PublicAttribute(true)]
    case ANESTHESIA = 31;

    #[NameAttribute('Blood and Blood Products')]
    #[CodeAttribute('038X')]
    #[PublicAttribute(true)]
    case BLOOD_AND_BLOOD_PRODUCTS = 32;

    #[NameAttribute('Administration, Processing and Storage for Blood and Blood Components')]
    #[CodeAttribute('039X')]
    #[PublicAttribute(true)]
    case ADMINISTRATION_PROCESSING_AND_STORAGE_FOR_BLOOD_AND_BLOOD_COMPONENTS = 33;

    #[NameAttribute('Other Imaging Services')]
    #[CodeAttribute('040X')]
    #[PublicAttribute(true)]
    case OTHER_IMAGING_SERVICES = 34;

    #[NameAttribute('Respiratory Services')]
    #[CodeAttribute('041X')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SERVICES = 35;

    #[NameAttribute('Physical Therapy')]
    #[CodeAttribute('042X')]
    #[PublicAttribute(true)]
    case PHYSICAL_THERAPY = 36;

    #[NameAttribute('Occupational Therapy')]
    #[CodeAttribute('043X')]
    #[PublicAttribute(true)]
    case OCCUPATIONAL_THERAPY = 37;

    #[NameAttribute('Speech Therapy Language Pathology')]
    #[CodeAttribute('044X')]
    #[PublicAttribute(true)]
    case SPEECH_THERAPY_LANGUAGE_PATHOLOGY = 38;

    #[NameAttribute('Emergency Room')]
    #[CodeAttribute('045X')]
    #[PublicAttribute(true)]
    case EMERGENCY_ROOM = 39;

    #[NameAttribute('Pulmonary Function')]
    #[CodeAttribute('046X')]
    #[PublicAttribute(true)]
    case PULMONARY_FUNCTION = 40;

    #[NameAttribute('Audiology')]
    #[CodeAttribute('047X')]
    #[PublicAttribute(true)]
    case AUDIOLOGY = 41;

    #[NameAttribute('Cardiology')]
    #[CodeAttribute('048X')]
    #[PublicAttribute(true)]
    case CARDIOLOGY = 42;

    #[NameAttribute('Ambulatory Surgical Care')]
    #[CodeAttribute('049X')]
    #[PublicAttribute(true)]
    case AMBULATORY_SURGICAL_CARE = 43;

    #[NameAttribute('Outpatient Services')]
    #[CodeAttribute('050X')]
    #[PublicAttribute(true)]
    case OUTPATIENT_SERVICES = 44;

    #[NameAttribute('Clinic')]
    #[CodeAttribute('051X')]
    #[PublicAttribute(true)]
    case CLINIC = 45;

    #[NameAttribute('Freestanding Clinic')]
    #[CodeAttribute('052X')]
    #[PublicAttribute(true)]
    case FREESTANDING_CLINIC = 46;

    #[NameAttribute('Osteopathic Services')]
    #[CodeAttribute('053X')]
    #[PublicAttribute(true)]
    case OSTEOPATHIC_SERVICES = 47;

    #[NameAttribute('Ambulance')]
    #[CodeAttribute('054X')]
    #[PublicAttribute(true)]
    case AMBULANCE = 48;

    #[NameAttribute('Skilled Nursing')]
    #[CodeAttribute('055X')]
    #[PublicAttribute(true)]
    case SKILLED_NURSING = 49;

    #[NameAttribute('Home Health Medical Social Services')]
    #[CodeAttribute('056X')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_MEDICAL_SOCIAL_SERVICES = 50;

    #[NameAttribute('Home Health Aide')]
    #[CodeAttribute('057X')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_AIDE = 51;

    #[NameAttribute('Home Health Other Visits')]
    #[CodeAttribute('058X')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_OTHER_VISITS = 52;

    #[NameAttribute('Home Health Units of Service')]
    #[CodeAttribute('059X')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_UNITS_OF_SERVICE = 53;

    #[NameAttribute('Home Health Oxygen')]
    #[CodeAttribute('060X')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_OXYGEN = 54;

    #[NameAttribute('Magnetic Resonance Technology (MRT)')]
    #[CodeAttribute('061X')]
    #[PublicAttribute(true)]
    case MAGNETIC_RESONANCE_TECHNOLOGY = 55;

    #[NameAttribute('Medical/Surgical Supplies - Extension of 027X')]
    #[CodeAttribute('062X')]
    #[PublicAttribute(true)]
    case MEDICAL_SURGICAL_SUPPLIES_EXTENSION = 56;

    #[NameAttribute('Pharmacy - Extension of 025X')]
    #[CodeAttribute('063X')]
    #[PublicAttribute(true)]
    case PHARMACY_EXTENSION = 57;

    #[NameAttribute('Home IV Therapy Services')]
    #[CodeAttribute('064X')]
    #[PublicAttribute(true)]
    case HOME_IV_THERAPY_SERVICES = 58;

    #[NameAttribute('Hospice Service')]
    #[CodeAttribute('065X')]
    #[PublicAttribute(true)]
    case HOSPICE_SERVICE = 59;

    #[NameAttribute('Respite Care')]
    #[CodeAttribute('066X')]
    #[PublicAttribute(true)]
    case RESPITE_CARE = 60;

    #[NameAttribute('Outpatient Special Residence Charges')]
    #[CodeAttribute('067X')]
    #[PublicAttribute(true)]
    case OUTPATIENT_SPECIAL_RESIDENCE_CHARGES = 61;

    #[NameAttribute('Trauma Response')]
    #[CodeAttribute('068X')]
    #[PublicAttribute(true)]
    case TRAUMA_RESPONSE = 62;

    #[NameAttribute('Pre-Hospice/Palliative Care Services')]
    #[CodeAttribute('069X')]
    #[PublicAttribute(true)]
    case PRE_HOSPICE_PALLIATIVE_CARE_SERVICES = 63;

    #[NameAttribute('Cast Room')]
    #[CodeAttribute('070X')]
    #[PublicAttribute(true)]
    case CAST_ROOM = 64;

    #[NameAttribute('Recovery Room')]
    #[CodeAttribute('071X')]
    #[PublicAttribute(true)]
    case RECOVERY_ROOM = 65;

    #[NameAttribute('Labor Room/Delivery')]
    #[CodeAttribute('072X')]
    #[PublicAttribute(true)]
    case LABOR_ROOM_DELIVERY = 66;

    #[NameAttribute('EKG/ECG Electrocardiogram')]
    #[CodeAttribute('073X')]
    #[PublicAttribute(true)]
    case EKG_ECG_ELECTROCARDIOGRAM = 67;

    #[NameAttribute('EEG Electroencephalogram')]
    #[CodeAttribute('074X')]
    #[PublicAttribute(true)]
    case EEG_ELECTROENCEPHALOGRAM = 68;

    #[NameAttribute('Gastrointestinal Services')]
    #[CodeAttribute('075X')]
    #[PublicAttribute(true)]
    case GASTROINTESTINAL_SERVICES = 69;

    #[NameAttribute('Specialty Services')]
    #[CodeAttribute('076X')]
    #[PublicAttribute(true)]
    case SPECIALTY_SERVICES = 70;

    #[NameAttribute('Preventive Services')]
    #[CodeAttribute('077X')]
    #[PublicAttribute(true)]
    case PREVENTIVE_SERVICES = 71;

    #[NameAttribute('Telemedicine')]
    #[CodeAttribute('078X')]
    #[PublicAttribute(true)]
    case TELEMEDICINE = 72;

    #[NameAttribute('Extra-Corporeal Shock Wave Therapy (formerly Lithotripsy)')]
    #[CodeAttribute('079X')]
    #[PublicAttribute(true)]
    case EXTRA_CORPOREAL_SHOCK_WAVE_THERAPY = 73;

    #[NameAttribute('Inpatient Renal Dialysis')]
    #[CodeAttribute('080X')]
    #[PublicAttribute(true)]
    case INPATIENT_RENAL_DIALYSIS = 74;

    #[NameAttribute('Acquisition of Body Components')]
    #[CodeAttribute('081X')]
    #[PublicAttribute(true)]
    case ACQUISITION_OF_BODY_COMPONENTS = 75;

    #[NameAttribute('Hemodialysis - Outpatient or Home')]
    #[CodeAttribute('082X')]
    #[PublicAttribute(true)]
    case HEMODIALYSIS = 76;

    #[NameAttribute('Peritoneal Dialysis - Outpatient or Home')]
    #[CodeAttribute('083X')]
    #[PublicAttribute(true)]
    case PERITONEAL_DIALYSIS = 77;

    #[NameAttribute('Continuous Ambulatory Peritoneal Dialysis (CAPD)- Outpatient or Home')]
    #[CodeAttribute('084X')]
    #[PublicAttribute(true)]
    case CONTINUOUS_AMBULATORY_PERITONEAL_DIALYSIS = 78;

    #[NameAttribute('Continuous Cycling Peritoneal Dialysis (CCPD) - Outpatient or Home')]
    #[CodeAttribute('085X')]
    #[PublicAttribute(true)]
    case CONTINUOUS_CYCLING_PERITONEAL_DIALYSIS = 79;

    #[NameAttribute('Magnetoencephalography')]
    #[CodeAttribute('086X')]
    #[PublicAttribute(true)]
    case MAGNETOENCEPHALOGRAPHY = 80;

    #[NameAttribute('Cell/Gene Therapy')]
    #[CodeAttribute('087X')]
    #[PublicAttribute(true)]
    case CELL_GENE_THERAPY = 81;

    #[NameAttribute('Miscellaneous Dialysis')]
    #[CodeAttribute('088X')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DIALYSIS = 82;

    #[NameAttribute('Pharmacy - Extension of 025X and 063X')]
    #[CodeAttribute('089X')]
    #[PublicAttribute(true)]
    case PHARMACY_EXTENSION_025X_063X = 83;

    #[NameAttribute('Behavioral Health Treatments/Services (also see 091X, and extension of 090X)')]
    #[CodeAttribute('090X')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_TREATMENTS_SERVICES = 84;

    #[NameAttribute('Behavioral Health Treatments/Services - Extension of 090X')]
    #[CodeAttribute('091X')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_TREATMENTS_SERVICES_EXTENSION = 85;

    #[NameAttribute('Other Diagnostic Services')]
    #[CodeAttribute('092X')]
    #[PublicAttribute(true)]
    case OTHER_DIAGNOSTIC_SERVICES = 86;

    #[NameAttribute('Medical Rehabilitation Day Program')]
    #[CodeAttribute('093X')]
    #[PublicAttribute(true)]
    case MEDICAL_REHABILITATION_DAY_PROGRAM = 87;

    #[NameAttribute('Other Therapeutic Services - See also 095X')]
    #[CodeAttribute('094X')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES = 88;

    #[NameAttribute('Other Therapeutic Services (Extension of 094X)')]
    #[CodeAttribute('095X')]
    #[PublicAttribute(true)]
    case OTHER_THERAPEUTIC_SERVICES_EXTENSION = 89;

    #[NameAttribute('Professional Fees')]
    #[CodeAttribute('096X')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES = 90;

    #[NameAttribute('Professional Fees (Extension of 096X)')]
    #[CodeAttribute('097X')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES_EXTENSION = 91;

    #[NameAttribute('Professional Fees (Extension of 096X and 097X)')]
    #[CodeAttribute('098X')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_FEES_EXTENSION_096X_097X = 92;

    #[NameAttribute('Patient Convenience Items')]
    #[CodeAttribute('099X')]
    #[PublicAttribute(true)]
    case PATIENT_CONVENIENCE_ITEMS = 93;

    #[NameAttribute('Behavioral Health Accommodations')]
    #[CodeAttribute('100X')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_ACCOMMODATIONS = 94;

    #[NameAttribute('Alternative Therapy Services')]
    #[CodeAttribute('210X')]
    #[PublicAttribute(true)]
    case ALTERNATIVE_THERAPY_SERVICES = 95;

    #[NameAttribute('Adult Care')]
    #[CodeAttribute('310X')]
    #[PublicAttribute(true)]
    case ADULT_CARE = 96;
}
