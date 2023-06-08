<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ProceduresProfessionalType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Vaccine Administration')]
    #[PublicAttribute(true)]
    case VACCIONE_ADMINISTRATION = 1;

    #[NameAttribute('Analysis of Semen Specimen')]
    #[PublicAttribute(true)]
    case ANALYSIS_OF_SEMEN_SPECIMEN = 2;

    #[NameAttribute('MIPS Measures')]
    #[PublicAttribute(true)]
    case MIPS_MEASURES = 3;

    #[NameAttribute('Professional Services for Drug Infusion')]
    #[PublicAttribute(true)]
    case PROFESSIONAL_SERVICES_FOR_DRUG_INFUSION = 4;

    #[NameAttribute('Telemed Services')]
    #[PublicAttribute(true)]
    case TELEMED_SERVICES = 5;

    #[NameAttribute('Home Care Management Services')]
    #[PublicAttribute(true)]
    case HOME_CARE_MANAGEMENT_SERVICES = 6;

    #[NameAttribute('Initial Visit for Professional Services')]
    #[PublicAttribute(true)]
    case INITIAL_VISIT_FOR_PROFESSIONAL_SERVICES = 7;

    #[NameAttribute('Screening Examinations and Disease Management Training')]
    #[PublicAttribute(true)]
    case SCREENING_EXAMINATIONS_AND_DISEASE_MANAGEMENT_TRAINING = 8;

    #[NameAttribute('Miscellaneous Diagnostic and Therapeutic Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DIAGNOSTIC_AND_THERAPEUTIC_SERVICES = 9;

    #[NameAttribute('Hospital Observation and Emergency Services')]
    #[PublicAttribute(true)]
    case HOSPITAL_OBSERVATION_AND_EMERGENCY_SERVICES = 10;

    #[NameAttribute('Other Emergency Services')]
    #[PublicAttribute(true)]
    case OTHER_EMERGENCY_SERVICES = 11;

    #[NameAttribute('Alcohol and Substance Abuse Assessments')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_SUBSTANCE_ABUSE_ASSESSMENTS = 12;

    #[NameAttribute('Sleep Studies, In Home')]
    #[PublicAttribute(true)]
    case SLEEP_STUDIES_IN_HOME = 13;

    #[NameAttribute('Initial Services for Medicare Enrollment')]
    #[PublicAttribute(true)]
    case INITIAL_SERVICES_FOR_MEDICARE_ENROLLMENT = 14;

    #[NameAttribute('Followup Telehealth Consultations')]
    #[PublicAttribute(true)]
    case FOLLOWUP_TELEHEALTH_CONSULTATIONS = 15;

    #[NameAttribute('Psychological Services')]
    #[PublicAttribute(true)]
    case PSYCHOLOGICAL_SERVICES = 16;

    #[NameAttribute('Fracture Treatment')]
    #[PublicAttribute(true)]
    case FRACTURE_TREATMENT = 17;

    #[NameAttribute('Gross and Microscopic Examinations, Prostate Biopsy')]
    #[PublicAttribute(true)]
    case GROSS_AND_MICROSCOPIC_EXAMINATIONS_PROSTATE_BIOPSY = 18;

    #[NameAttribute('Face-to-Face Educational Services')]
    #[PublicAttribute(true)]
    case FACE_TO_FACE_EDUCATIONAL_SERVICES = 19;

    #[NameAttribute('Cardiac and Pulmonary Rehabilitation Services')]
    #[PublicAttribute(true)]
    case CARDIAC_AND_PULMONARY_REHABILITATION_SERVICES = 20;

    #[NameAttribute('Initial Telehealth Consultations')]
    #[PublicAttribute(true)]
    case INITIAL_TELEHEALTH_CONSULTATIONS = 21;

    #[NameAttribute('Filler Procedures')]
    #[PublicAttribute(true)]
    case FILLER_PROCEDURES = 22;

    #[NameAttribute('Laboratory Screening Tests')]
    #[PublicAttribute(true)]
    case LABORATORY_SCREENING_TESTS = 23;

    #[NameAttribute('Counseling, Screening, and Prevention Services')]
    #[PublicAttribute(true)]
    case COUNSELING_SCREENING_AND_PREVENTION_SERVICES = 24;

    #[NameAttribute('Miscellaneous Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SERVICES = 25;

    #[NameAttribute('Federally Qualified Health Center (FQHC) Visits')]
    #[PublicAttribute(true)]
    case FEDERALLY_QUALIFIED_HEALTH_CENTER_FQHC_VISITS = 26;

    #[NameAttribute('Other Services')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 27;

    #[NameAttribute('Quality Measures for Cataract Surgery')]
    #[PublicAttribute(true)]
    case QUALITY_MEASURES_FOR_CATARACT_SURGERY = 28;

    #[NameAttribute('Clinical Decision Support Mechanism (CDSM)')]
    #[PublicAttribute(true)]
    case CLINICAL_DECISION_SUPPORT_MECHANISM_CDSM = 29;

    #[NameAttribute('Convulsive Therapy Procedure')]
    #[PublicAttribute(true)]
    case CONVULSIVE_THERAPY_PROCEDURE = 30;

    #[NameAttribute('Other Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case OTHER_EVALUATION_AND_MANAGEMENT_SERVICES = 31;

    #[NameAttribute('Care Management Services')]
    #[PublicAttribute(true)]
    case CARE_MANAGEMENT_SERVICES = 32;

    #[NameAttribute('Cardiac Device Evaluation')]
    #[PublicAttribute(true)]
    case CARDIAC_DEVICE_EVALUATION = 33;

    #[NameAttribute('Medication Assisted Treatment Programme')]
    #[PublicAttribute(true)]
    case MEDICATION_ASSISTED_TREATMENT_PROGRAMME = 34;

    #[NameAttribute('Opioid Use Disorder - Evaluation and Treatment')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_EVALUATION_AND_TREATMENT = 35;

    #[NameAttribute('Evaluation and Management Services')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_MANAGEMENT_SERVICES = 36;

    #[NameAttribute('Opioid Use Disorder - Treatment (Office Based)')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_TREATMENT_OFFICE_BASED = 37;

    #[NameAttribute('Functional Status')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS = 38;

    #[NameAttribute('Performance Measures')]
    #[PublicAttribute(true)]
    case PERFORMANCE_MEASURES = 39;

    #[NameAttribute('Therapy Maintenance Program in Home Health Setting')]
    #[PublicAttribute(true)]
    case THERAPY_MAINTENANCE_PROGRAM_IN_HOME_HEALTH_SETTING = 40;

    #[NameAttribute('Opioid Use Disorder (OUD) Treatment Services')]
    #[PublicAttribute(true)]
    case OPIOID_USE_DISORDER_OUD_TREATMENT_SERVICES = 41;

    #[NameAttribute('Clinician Documentation and Management Services')]
    #[PublicAttribute(true)]
    case CLINICIAN_DOCUMENTATION_AND_MANAGEMENT_SERVICES = 42;

    #[NameAttribute('Evaluation and Care Management Services')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_CARE_MANAGEMENT_SERVICES = 43;

    #[NameAttribute('Take Home Supplies')]
    #[PublicAttribute(true)]
    case TAKE_HOME_SUPPLIES = 44;

    #[NameAttribute('Documentation assessment (Remote)')]
    #[PublicAttribute(true)]
    case DOCUMENTATION_ASSESSMENT_REMOTE = 45;

    #[NameAttribute('Brief Communication Technology-Based Services')]
    #[PublicAttribute(true)]
    case BRIEF_COMMUNICATION_TECHNOLOGY_BASED_SERVICES = 46;

    #[NameAttribute('Chronic Pain Management And Treatment Services')]
    #[PublicAttribute(true)]
    case CHRONIC_PAIN_MANAGEMENT_AND_TREATMENT_SERVICES = 47;

    #[NameAttribute('MIPS Specialty Set')]
    #[PublicAttribute(true)]
    case MIPS_SPECIALTY_SET = 48;

    #[NameAttribute('Radiation Therapy Services')]
    #[PublicAttribute(true)]
    case RADIATION_THERAPY_SERVICES = 49;

    #[NameAttribute('Additional Quality Measures')]
    #[PublicAttribute(true)]
    case ADDITIONAL_QUALITY_MEASURES = 50;

    #[NameAttribute('Quality Measures Related for Risk-adjusted Functional Status Scoring')]
    #[PublicAttribute(true)]
    case QUALITY_MEASURES_RELATED_FOR_RISK_ADJUSTED_FUNCTIONAL_STATUS_SCORING = 51;

    #[NameAttribute('More Quality Measures')]
    #[PublicAttribute(true)]
    case MORE_QUALITY_MEASURES = 52;

    #[NameAttribute('MCCD (Medicare Coordinated Care Demonstration)')]
    #[PublicAttribute(true)]
    case MCCD_MEDICARE_COORDINATED_CARE_DEMONSTRATION = 53;

    #[NameAttribute('Medicare Demonstration Projects')]
    #[PublicAttribute(true)]
    case MEDICARE_DEMONSTRATION_PROJECTS = 54;

    #[NameAttribute('Warfarin Responsiveness Testing')]
    #[PublicAttribute(true)]
    case WARFARIN_RESPONSIVENESS_TESTING = 55;

    #[NameAttribute('Outpatient Intravenous Insulin Treatment')]
    #[PublicAttribute(true)]
    case OUTPATIENT_INTRAVENOUS_INSULIN_TREATMENT = 56;

    #[NameAttribute('Primary Care Quality Measures')]
    #[PublicAttribute(true)]
    case PRIMARY_CARE_QUALITY_MEASURES = 57;

    #[NameAttribute('Provider Assessment for Wheelchair')]
    #[PublicAttribute(true)]
    case PROVIDER_ASSESSMENT_FOR_WHEELCHAIR = 58;

    #[NameAttribute('Diagnostic Cardiac Doppler Ultrasound')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_CARDIAC_DOPPLER_ULTRASOUND = 59;

    #[NameAttribute('Bundled Payment Care')]
    #[PublicAttribute(true)]
    case BUNDLED_PAYMENT_CARE = 60;

    #[NameAttribute('Additional Assorted Quality Measures')]
    #[PublicAttribute(true)]
    case ADDITIONAL_ASSORTED_QUALITY_MEASURES = 61;

    #[NameAttribute('Radiology services Prostate')]
    #[PublicAttribute(true)]
    case RADIOLOGY_SERVICES_PROSTATE = 62;

    #[NameAttribute('Geriatric care Management')]
    #[PublicAttribute(true)]
    case GERIATRIC_CARE_MANAGEMENT = 63;

    #[NameAttribute('Breast screening/diagnostics/Therapeutics')]
    #[PublicAttribute(true)]
    case BREAST_SCREENING_DIAGNOSTICS_THERAPEUTICS = 64;

    #[NameAttribute('Additional Geriatric care Management')]
    #[PublicAttribute(true)]
    case ADDITIONAL_GERIATRIC_CARE_MANAGEMENT = 65;

    #[NameAttribute('Tobacco Screening')]
    #[PublicAttribute(true)]
    case TOBACCO_SCREENING = 66;

    #[NameAttribute('Other Geriatric care Management')]
    #[PublicAttribute(true)]
    case OTHER_GERIATRIC_CARE_MANAGEMENT = 67;

    #[NameAttribute('Breast screening (Therapeutics)')]
    #[PublicAttribute(true)]
    case BREAST_SCREENING_THERAPEUTICS = 68;

    #[NameAttribute('Anti TNF Diagnostics for HBV status')]
    #[PublicAttribute(true)]
    case ANTI_TNF_DIAGNOSTICS_FOR_HBV_STATUS = 69;

    #[NameAttribute('Functional Status codes')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS_CODES = 70;

    #[NameAttribute('Screening')]
    #[PublicAttribute(true)]
    case SCREENING = 71;

    #[NameAttribute('Geriatric Care Management and Other Services')]
    #[PublicAttribute(true)]
    case GERIATRIC_CARE_MANAGEMENT_AND_OTHER_SERVICES = 72;

    #[NameAttribute('Pain assessment')]
    #[PublicAttribute(true)]
    case PAIN_ASSESSMENT = 73;

    #[NameAttribute('Medications (Antiemetics and Antimicrobials)')]
    #[PublicAttribute(true)]
    case MEDICATIONS_ANTIEMETICS_AND_ANTIMICROBIALS = 74;

    #[NameAttribute('Embolization')]
    #[PublicAttribute(true)]
    case EMBOLIZATION = 75;

    #[NameAttribute('Screening, Wellness and Physician visits')]
    #[PublicAttribute(true)]
    case SCREENING_WELLNESS_AND_PHYSICIAN_VISITS = 76;

    #[NameAttribute('Vision Assessment')]
    #[PublicAttribute(true)]
    case VISION_ASSESSMENT = 77;

    #[NameAttribute('Remote In-House Evaluation And Management Assessment')]
    #[PublicAttribute(true)]
    case REMOTE_IN_HOUSE_EVALUATION_AND_MANAGEMENT_ASSESSMENT = 78;

    #[NameAttribute('Palliative Care Services')]
    #[PublicAttribute(true)]
    case PALLIATIVE_CARE_SERVICES = 79;
}
