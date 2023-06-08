<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum ProceduresProfessionalType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Vaccine Administration')]
    #[RangeAttribute('G0008', 'G0010')]
    #[PublicAttribute(true)]
    case VACCIONE_ADMINISTRATION = 1;

    #[NameAttribute('Analysis of Semen Specimen')]
    #[RangeAttribute('G0027', 'G0027')]
    #[PublicAttribute(true)]
    case ANALYSIS_OF_SEMEN_SPECIMEN = 2;

    #[NameAttribute('MIPS Measures')]
    #[RangeAttribute('G0028', 'G0067')]
    #[PublicAttribute(true)]
    case MIPS_MEASURES = 3;

    #[NameAttribute('Professional Services for Drug Infusion')]
    #[RangeAttribute('G0068', 'G0070')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_SERVICES_FOR_DRUG_INFUSION = 4;

    #[NameAttribute('Telemed Services')]
    #[RangeAttribute('G0071', 'G0071')]
    #[PublicAttribute(true)]
    case TELEMED_SERVICES = 5;

    #[NameAttribute('Home Care Management Services')]
    #[RangeAttribute('G0076', 'G0087')]
    #[PublicAttribute(true)]
    case HOME_CARE_MANAGEMENT_SERVICES = 6;

    #[NameAttribute('Initial Visit for Professional Services')]
    #[RangeAttribute('G0088', 'G0090')]
    #[PublicAttribute(true)]
    case INITIAL_VISIT_FOR_PROFESSIONAL_SERVICES = 7;

    #[NameAttribute('Screening Examinations and Disease Management Training')]
    #[RangeAttribute('G0101', 'G0124')]
    #[PublicAttribute(true)]
    case SCREENING_EXAMINATIONS_AND_DISEASE_MANAGEMENT_TRAINING = 8;

    #[NameAttribute('Miscellaneous Diagnostic and Therapeutic Services')]
    #[RangeAttribute('G0127', 'G0372')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DIAGNOSTIC_AND_THERAPEUTIC_SERVICES = 9;

    #[NameAttribute('Hospital Observation and Emergency Services')]
    #[RangeAttribute('G0378', 'G0384')]
    #[PublicAttribute(true)]
    case HOSPITAL_OBSERVATION_AND_EMERGENCY_SERVICES = 10;

    #[NameAttribute('Other Emergency Services')]
    #[RangeAttribute('G0390', 'G0390')]
    #[PublicAttribute(true)]
    case OTHER_EMERGENCY_SERVICES = 11;

    #[NameAttribute('Alcohol and Substance Abuse Assessments')]
    #[RangeAttribute('G0396', 'G0397')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_SUBSTANCE_ABUSE_ASSESSMENTS = 12;

    #[NameAttribute('Sleep Studies, In Home')]
    #[RangeAttribute('G0398', 'G0400')]
    #[PublicAttribute(true)]
    case SLEEP_STUDIES_IN_HOME = 13;

    #[NameAttribute('Initial Services for Medicare Enrollment')]
    #[RangeAttribute('G0402', 'G0405')]
    #[PublicAttribute(true)]
    case INITIAL_SERVICES_FOR_MEDICARE_ENROLLMENT = 14;

    #[NameAttribute('Followup Telehealth Consultations')]
    #[RangeAttribute('G0406', 'G0408')]
    #[PublicAttribute(true)]
    case FOLLOWUP_TELEHEALTH_CONSULTATIONS = 15;

    #[NameAttribute('Psychological Services')]
    #[RangeAttribute('G0409', 'G0411')]
    #[PublicAttribute(true)]
    case PSYCHOLOGICAL_SERVICES = 16;

    #[NameAttribute('Fracture Treatment')]
    #[RangeAttribute('G0412', 'G0415')]
    #[PublicAttribute(true)]
    case FRACTURE_TREATMENT = 17;

    #[NameAttribute('Gross and Microscopic Examinations, Prostate Biopsy')]
    #[RangeAttribute('G0416', 'G0416')]
    #[PublicAttribute(true)]
    case GROSS_AND_MICROSCOPIC_EXAMINATIONS_PROSTATE_BIOPSY = 18;

    #[NameAttribute('Face-to-Face Educational Services')]
    #[RangeAttribute('G0420', 'G0421')]
    #[PublicAttribute(true)]
    case FACE_TO_FACE_EDUCATIONAL_SERVICES = 19;

    #[NameAttribute('Cardiac and Pulmonary Rehabilitation Services')]
    #[RangeAttribute('G0422', 'G0424')]
    #[PublicAttribute(true)]
    case CARDIAC_AND_PULMONARY_REHABILITATION_SERVICES = 20;

    #[NameAttribute('Initial Telehealth Consultations')]
    #[RangeAttribute('G0425', 'G0427')]
    #[PublicAttribute(true)]
    case INITIAL_TELEHEALTH_CONSULTATIONS = 21;

    #[NameAttribute('Filler Procedures')]
    #[RangeAttribute('G0428', 'G0429')]
    #[PublicAttribute(true)]
    case FILLER_PROCEDURES = 22;

    #[NameAttribute('Laboratory Screening Tests')]
    #[RangeAttribute('G0432', 'G0435')]
    #[PublicAttribute(true)]
    case LABORATORY_SCREENING_TESTS = 23;

    #[NameAttribute('Counseling, Screening, and Prevention Services')]
    #[RangeAttribute('G0438', 'G0451')]
    #[PublicAttribute(true)]
    case COUNSELING_SCREENING_AND_PREVENTION_SERVICES = 24;

    #[NameAttribute('Miscellaneous Services')]
    #[RangeAttribute('G0452', 'G0465')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SERVICES = 25;

    #[NameAttribute('Federally Qualified Health Center (FQHC) Visits')]
    #[RangeAttribute('G0466', 'G0470')]
    #[PublicAttribute(true)]
    case FEDERALLY_QUALIFIED_HEALTH_CENTER_FQHC_VISITS = 26;

    #[NameAttribute('Other Services')]
    #[RangeAttribute('G0471', 'G0659')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 27;

    #[NameAttribute('Quality Measures for Cataract Surgery')]
    #[RangeAttribute('G0913', 'G0918')]
    #[PublicAttribute(true)]
    case QUALITY_MEASURES_FOR_CATARACT_SURGERY = 28;

    #[NameAttribute('Clinical Decision Support Mechanism (CDSM)')]
    #[RangeAttribute('G1001', 'G1028')]
    #[PublicAttribute(true)]
    case CLINICAL_DECISION_SUPPORT_MECHANISM_CDSM = 29;

    #[NameAttribute('Convulsive Therapy Procedure')]
    #[RangeAttribute('G2000', 'G2000')]
    #[PublicAttribute(true)]
    case CONVULSIVE_THERAPY_PROCEDURE = 30;

    #[NameAttribute('Other Evaluation and Management Services')]
    #[RangeAttribute('G2001', 'G2020')]
    #[PublicAttribute(true)]
    case OTHER_EVALUATION_AND_MANAGEMENT_SERVICES = 31;

    #[NameAttribute('Care Management Services')]
    #[RangeAttribute('G2021', 'G2025')]
    #[PublicAttribute(true)]
    case CARE_MANAGEMENT_SERVICES = 32;

    #[NameAttribute('Cardiac Device Evaluation')]
    #[RangeAttribute('G2066', 'G2066')]
    #[PublicAttribute(true)]
    case CARDIAC_DEVICE_EVALUATION = 33;

    #[NameAttribute('Medication Assisted Treatment Programme')]
    #[RangeAttribute('G2067', 'G2075')]
    #[PublicAttribute(true)]
    case MEDICATION_ASSISTED_TREATMENT_PROGRAMME = 34;

    #[NameAttribute('Opioid Use Disorder - Evaluation and Treatment')]
    #[RangeAttribute('G2076', 'G2081')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_EVALUATION_AND_TREATMENT = 35;

    #[NameAttribute('Evaluation and Management Services')]
    #[RangeAttribute('G2082', 'G2083')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_MANAGEMENT_SERVICES = 36;

    #[NameAttribute('Opioid Use Disorder - Treatment (Office Based)')]
    #[RangeAttribute('G2086', 'G2088')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_TREATMENT_OFFICE_BASED = 37;

    #[NameAttribute('Functional Status')]
    #[RangeAttribute('G2090', 'G2152')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS = 38;

    #[NameAttribute('Performance Measures')]
    #[RangeAttribute('G2167', 'G2167')]
    #[PublicAttribute(true)]
    case PERFORMANCE_MEASURES = 39;

    #[NameAttribute('Therapy Maintenance Program in Home Health Setting')]
    #[RangeAttribute('G2168', 'G2169')]
    #[PublicAttribute(true)]
    case THERAPY_MAINTENANCE_PROGRAM_IN_HOME_HEALTH_SETTING = 40;

    #[NameAttribute('Opioid Use Disorder (OUD) Treatment Services')]
    #[RangeAttribute('G2172', 'G2172')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_OUD_TREATMENT_SERVICES = 41;

    #[NameAttribute('Clinician Documentation and Management Services')]
    #[RangeAttribute('G2173', 'G2210')]
    #[PublicAttribute(true)]
    case CLINICIAN_DOCUMENTATION_AND_MANAGEMENT_SERVICES = 42;

    #[NameAttribute('Evaluation and Care Management Services')]
    #[RangeAttribute('G2211', 'G2214')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_CARE_MANAGEMENT_SERVICES = 43;

    #[NameAttribute('Take Home Supplies')]
    #[RangeAttribute('G2215', 'G2216')]
    #[PublicAttribute(true)]
    case TAKE_HOME_SUPPLIES = 44;

    #[NameAttribute('Documentation assessment (Remote)')]
    #[RangeAttribute('G2250', 'G2250')]
    #[PublicAttribute(true)]
    case DOCUMENTATION_ASSESSMENT_REMOTE = 45;

    #[NameAttribute('Brief Communication Technology-Based Services')]
    #[RangeAttribute('G2251', 'G2252')]
    #[PublicAttribute(true)]
    case BRIEF_COMMUNICATION_TECHNOLOGY_BASED_SERVICES = 46;

    #[NameAttribute('Chronic Pain Management And Treatment Services')]
    #[RangeAttribute('G3002', 'G3003')]
    #[PublicAttribute(true)]
    case CHRONIC_PAIN_MANAGEMENT_AND_TREATMENT_SERVICES = 47;

    #[NameAttribute('MIPS Specialty Set')]
    #[RangeAttribute('G4000', 'G4038')]
    #[PublicAttribute(true)]
    case MIPS_SPECIALTY_SET = 48;

    #[NameAttribute('Radiation Therapy Services')]
    #[RangeAttribute('G6001', 'G6017')]
    #[PublicAttribute(true)]
    case RADIATION_THERAPY_SERVICES = 49;

    #[NameAttribute('Additional Quality Measures')]
    #[RangeAttribute('G8395', 'G8635')]
    #[PublicAttribute(true)]
    case ADDITIONAL_QUALITY_MEASURES = 50;

    #[NameAttribute('Quality Measures Related for Risk-adjusted Functional Status Scoring')]
    #[RangeAttribute('G8647', 'G8670')]
    #[PublicAttribute(true)]
    case QUALITY_MEASURES_RELATED_FOR_RISK_ADJUSTED_FUNCTIONAL_STATUS_SCORING = 51;

    #[NameAttribute('More Quality Measures')]
    #[RangeAttribute('G8694', 'G8970')]
    #[PublicAttribute(true)]
    case MORE_QUALITY_MEASURES = 52;

    #[NameAttribute('MCCD (Medicare Coordinated Care Demonstration)')]
    #[RangeAttribute('G9001', 'G9012')]
    #[PublicAttribute(true)]
    case MCCD_MEDICARE_COORDINATED_CARE_DEMONSTRATION = 53;

    #[NameAttribute('Medicare Demonstration Projects')]
    #[RangeAttribute('G9013', 'G9140')]
    #[PublicAttribute(true)]
    case MEDICARE_DEMONSTRATION_PROJECTS = 54;

    #[NameAttribute('Warfarin Responsiveness Testing')]
    #[RangeAttribute('G9143', 'G9143')]
    #[PublicAttribute(true)]
    case WARFARIN_RESPONSIVENESS_TESTING = 55;

    #[NameAttribute('Outpatient Intravenous Insulin Treatment')]
    #[RangeAttribute('G9147', 'G9147')]
    #[PublicAttribute(true)]
    case OUTPATIENT_INTRAVENOUS_INSULIN_TREATMENT = 56;

    #[NameAttribute('Primary Care Quality Measures')]
    #[RangeAttribute('G9148', 'G9153')]
    #[PublicAttribute(true)]
    case PRIMARY_CARE_QUALITY_MEASURES = 57;

    #[NameAttribute('Provider Assessment for Wheelchair')]
    #[RangeAttribute('G9156', 'G9156')]
    #[PublicAttribute(true)]
    case PROVIDER_ASSESSMENT_FOR_WHEELCHAIR = 58;

    #[NameAttribute('Diagnostic Cardiac Doppler Ultrasound')]
    #[RangeAttribute('G9157', 'G9157')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_CARDIAC_DOPPLER_ULTRASOUND = 59;

    #[NameAttribute('Bundled Payment Care')]
    #[RangeAttribute('G9187', 'G9187')]
    #[PublicAttribute(true)]
    case BUNDLED_PAYMENT_CARE = 60;

    #[NameAttribute('Additional Assorted Quality Measures')]
    #[RangeAttribute('G9188', 'G9893')]
    #[PublicAttribute(true)]
    case ADDITIONAL_ASSORTED_QUALITY_MEASURES = 61;

    #[NameAttribute('Radiology services Prostate')]
    #[RangeAttribute('G9894', 'G9897')]
    #[PublicAttribute(true)]
    case RADIOLOGY_SERVICES_PROSTATE = 62;

    #[NameAttribute('Geriatric care Management')]
    #[RangeAttribute('G9898', 'G9898')]
    #[PublicAttribute(true)]
    case GERIATRIC_CARE_MANAGEMENT = 63;

    #[NameAttribute('Breast screening/diagnostics/Therapeutics')]
    #[RangeAttribute('G9899', 'G9900')]
    #[PublicAttribute(true)]
    case BREAST_SCREENING_DIAGNOSTICS_THERAPEUTICS = 64;

    #[NameAttribute('Additional Geriatric care Management')]
    #[RangeAttribute('G9901', 'G9901')]
    #[PublicAttribute(true)]
    case ADDITIONAL_GERIATRIC_CARE_MANAGEMENT = 65;

    #[NameAttribute('Tobacco Screening')]
    #[RangeAttribute('G9902', 'G9909')]
    #[PublicAttribute(true)]
    case TOBACCO_SCREENING = 66;

    #[NameAttribute('Other Geriatric care Management')]
    #[RangeAttribute('G9910', 'G9910')]
    #[PublicAttribute(true)]
    case OTHER_GERIATRIC_CARE_MANAGEMENT = 67;

    #[NameAttribute('Breast screening (Therapeutics)')]
    #[RangeAttribute('G9911', 'G9911')]
    #[PublicAttribute(true)]
    case BREAST_SCREENING_THERAPEUTICS = 68;

    #[NameAttribute('Anti TNF Diagnostics for HBV status')]
    #[RangeAttribute('G9912', 'G9915')]
    #[PublicAttribute(true)]
    case ANTI_TNF_DIAGNOSTICS_FOR_HBV_STATUS = 69;

    #[NameAttribute('Functional Status codes')]
    #[RangeAttribute('G9916', 'G9918')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS_CODES = 70;

    #[NameAttribute('Screening')]
    #[RangeAttribute('G9919', 'G9932')]
    #[PublicAttribute(true)]
    case SCREENING = 71;

    #[NameAttribute('Geriatric Care Management and Other Services')]
    #[RangeAttribute('G9938', 'G9940')]
    #[PublicAttribute(true)]
    case GERIATRIC_CARE_MANAGEMENT_AND_OTHER_SERVICES = 72;

    #[NameAttribute('Pain assessment')]
    #[RangeAttribute('G9942', 'G9949')]
    #[PublicAttribute(true)]
    case PAIN_ASSESSMENT = 73;

    #[NameAttribute('Medications (Antiemetics and Antimicrobials)')]
    #[RangeAttribute('G9954', 'G9961')]
    #[PublicAttribute(true)]
    case MEDICATIONS_ANTIEMETICS_AND_ANTIMICROBIALS = 74;

    #[NameAttribute('Embolization')]
    #[RangeAttribute('G9962', 'G9963')]
    #[PublicAttribute(true)]
    case EMBOLIZATION = 75;

    #[NameAttribute('Screening, Wellness and Physician visits')]
    #[RangeAttribute('G9964', 'G9970')]
    #[PublicAttribute(true)]
    case SCREENING_WELLNESS_AND_PHYSICIAN_VISITS = 76;

    #[NameAttribute('Vision Assessment')]
    #[RangeAttribute('G9974', 'G9975')]
    #[PublicAttribute(true)]
    case VISION_ASSESSMENT = 77;

    #[NameAttribute('Remote In-House Evaluation And Management Assessment')]
    #[RangeAttribute('G9978', 'G9987')]
    #[PublicAttribute(true)]
    case REMOTE_IN_HOUSE_EVALUATION_AND_MANAGEMENT_ASSESSMENT = 78;

    #[NameAttribute('Palliative Care Services')]
    #[RangeAttribute('G9988', 'G9999')]
    #[PublicAttribute(true)]
    case PALLIATIVE_CARE_SERVICES = 79;
}
