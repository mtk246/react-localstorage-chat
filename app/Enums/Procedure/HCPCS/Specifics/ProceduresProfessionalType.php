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

    // Vaccine Administration
    // Analysis of Semen Specimen
    // MIPS Measures
    // Professional Services for Drug Infusion
    // Telemed Services
    // Home Care Management Services
    // Initial Visit for Professional Services
    // Screening Examinations and Disease Management Training
    // Miscellaneous Diagnostic and Therapeutic Services
    // Hospital Observation and Emergency Services
    // Other Emergency Services
    // Alcohol and Substance Abuse Assessments
    // Sleep Studies, In Home
    // Initial Services for Medicare Enrollment
    // Followup Telehealth Consultations
    // Psychological Services
    // Fracture Treatment
    // Gross and Microscopic Examinations, Prostate Biopsy
    // Face-to-Face Educational Services
    // Cardiac and Pulmonary Rehabilitation Services
    // Initial Telehealth Consultations
    // Filler Procedures
    // Laboratory Screening Tests
    // Counseling, Screening, and Prevention Services
    // Miscellaneous Services
    // Federally Qualified Health Center (FQHC) Visits
    // Other Services
    // Quality Measures for Cataract Surgery
    // Clinical Decision Support Mechanism (CDSM)
    // Convulsive Therapy Procedure
    // Other Evaluation and Management Services
    // Care Management Services
    // Cardiac Device Evaluation
    // Medication Assisted Treatment Programme
    // Opioid Use Disorder - Evaluation and Treatment
    // Evaluation and Management Services
    // Opioid Use Disorder - Treatment (Office Based)
    // Functional Status
    // Performance Measures
    // Therapy Maintenance Program in Home Health Setting
    // Opioid Use Disorder (OUD) Treatment Services
    // Clinician Documentation and Management Services
    // Evaluation and Care Management Services
    // Take Home Supplies
    // Documentation assessment (Remote)
    // Brief Communication Technology-Based Services
    // Chronic Pain Management And Treatment Services
    // MIPS Specialty Set
    // Radiation Therapy Services
    // Additional Quality Measures
    // Quality Measures Related for Risk-adjusted Functional Status Scoring
    // More Quality Measures
    // MCCD (Medicare Coordinated Care Demonstration)
    // Medicare Demonstration Projects
    // Warfarin Responsiveness Testing
    // Outpatient Intravenous Insulin Treatment
    // Primary Care Quality Measures
    // Provider Assessment for Wheelchair
    // Diagnostic Cardiac Doppler Ultrasound
    // Bundled Payment Care
    // Additional Assorted Quality Measures
    // Radiology services Prostate
    // Geriatric care Management
    // Breast screening/diagnostics/Therapeutics
    // Additional Geriatric care Management
    // Tobacco Screening
    // Other Geriatric care Management
    // Breast screening (Therapeutics)
    // Anti TNF Diagnostics for HBV status
    // Functional Status codes
    // Screening
    // Geriatric Care Management and Other Services
    // Pain assessment
    // Medications (Antiemetics and Antimicrobials)
    // Embolization
    // Screening, Wellness and Physician visits
    // Vision Assessment
    // Remote In-House Evaluation And Management Assessment
    // Palliative Care Services
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}
