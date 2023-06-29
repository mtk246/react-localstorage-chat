<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum MedicineAndDiagnosesType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('Immune Globulins, Serum or Recombinant Products')]
    #[RangeAttribute('90281', '90399')]
    #[PublicAttribute(true)]
    case IMMNUME_GLOBULINS = 1;

    #[NameAttribute('Immunization Administration for Vaccines/Toxoids')]
    #[RangeAttribute('90460', '90174')]
    #[PublicAttribute(true)]
    case IMMUNIZATION_ADMINISTRATION = 2;

    #[NameAttribute('Vaccines, Toxoids')]
    #[RangeAttribute('90476', '90759')]
    #[PublicAttribute(true)]
    case VACCINES = 3;

    #[NameAttribute('Psychiatry Services and Diagnoses')]
    #[RangeAttribute('90785', '90899')]
    #[PublicAttribute(true)]
    case PSYCHIATRY = 4;

    #[NameAttribute('Biofeedback Services and Diagnoses')]
    #[RangeAttribute('90901', '90913')]
    #[PublicAttribute(true)]
    case BIOFEEDBACK = 5;

    #[NameAttribute('Dialysis Services and Diagnoses')]
    #[RangeAttribute('90935', '90999')]
    #[PublicAttribute(true)]
    case DIALYSIS = 6;

    #[NameAttribute('Gastroenterology Diagnoses')]
    #[RangeAttribute('91010', '91315')]
    #[PublicAttribute(true)]
    case GASTROENTEROLOGY = 7;

    #[NameAttribute('Ophthalmology Services and Diagnoses')]
    #[RangeAttribute('92002', '92499')]
    #[PublicAttribute(true)]
    case OPHTHALMOLOGY = 8;

    #[NameAttribute('Special Otorhinolaryngologic Services and Diagnoses')]
    #[RangeAttribute('92502', '92700')]
    #[PublicAttribute(true)]
    case OTORHINOLARYNGOLOGY = 9;

    #[NameAttribute('Cardiovascular Diagnoses')]
    #[RangeAttribute('92920', '93799')]
    #[PublicAttribute(true)]
    case CARDIOVASCULAR = 10;

    #[NameAttribute('Non-Invasive Vascular Diagnostic Studies')]
    #[RangeAttribute('93880', '93998')]
    #[PublicAttribute(true)]
    case VASCULAR = 11;

    #[NameAttribute('Pulmonary Diagnoses')]
    #[RangeAttribute('94002', '94799')]
    #[PublicAttribute(true)]
    case PULMONARY = 12;

    #[NameAttribute('Allergy and Clinical Immunology Diagnoses')]
    #[RangeAttribute('95004', '95199')]
    #[PublicAttribute(true)]
    case ALLERGY = 13;

    #[NameAttribute('Endocrinology Services')]
    #[RangeAttribute('95249', '95251')]
    #[PublicAttribute(true)]
    case ENDOCRINOLOGY = 14;

    #[NameAttribute('Neurology and Neuromuscular Diagnoses')]
    #[RangeAttribute('95700', '96020')]
    #[PublicAttribute(true)]
    case NEUROLOGY = 15;

    #[NameAttribute('Medical Genetics and Genetic Counseling Services')]
    #[RangeAttribute('96040', '96040')]
    #[PublicAttribute(true)]
    case MEDICAL_GENETICS = 16;

    #[NameAttribute('Central Nervous System Assessments/Tests (eg, Neuro-Cognitive, Mental Status, Speech Testing)')]
    #[RangeAttribute('96105', '96146')]
    #[PublicAttribute(true)]
    case CENTRAL_NERVOUS_SYSTEM = 17;

    #[NameAttribute('Health Behavior Assessment and Intervention Diagnoses')]
    #[RangeAttribute('96156', '96171')]
    #[PublicAttribute(true)]
    case HEALTH_BEHAVIOR = 18;

    #[NameAttribute('Behavior Management Services')]
    #[RangeAttribute('96202', '96203')]
    #[PublicAttribute(true)]
    case BEHAVIOR_MANAGEMENT = 19;

    #[NameAttribute('Hydration, Therapeutic, Prophylactic, Diagnostic Injections and Infusions, and Chemotherapy and Other Highly Complex Drug or Highly Complex Biologic Agent Administration')]
    #[RangeAttribute('96360', '96549')]
    #[PublicAttribute(true)]
    case HYDRATION = 20;

    #[NameAttribute('Photodynamic Therapy Diagnoses')]
    #[RangeAttribute('96567', '96574')]
    #[PublicAttribute(true)]
    case PHOTODYNAMIC_THERAPY = 21;

    #[NameAttribute('Special Dermatological Diagnoses')]
    #[RangeAttribute('96900', '96999')]
    #[PublicAttribute(true)]
    case SPECIAL_DERMATOLOGICAL = 22;

    #[NameAttribute('Physical Medicine and Rehabilitation Evaluations')]
    #[RangeAttribute('97010', '97799')]
    #[PublicAttribute(true)]
    case PHYSICAL_MEDICINE = 23;

    #[NameAttribute('Adaptive Behavior Services')]
    #[RangeAttribute('97151', '97158')]
    #[PublicAttribute(true)]
    case ADAPTIVE_BEHAVIOR = 24;

    #[NameAttribute('Medical Nutrition Therapy Diagnoses')]
    #[RangeAttribute('97802', '97804')]
    #[PublicAttribute(true)]
    case MEDICAL_NUTRITION = 25;

    #[NameAttribute('Acupuncture Diagnoses')]
    #[RangeAttribute('97810', '97814')]
    #[PublicAttribute(true)]
    case ACUPUNCTURE = 26;

    #[NameAttribute('Osteopathic Manipulative Treatment Diagnoses')]
    #[RangeAttribute('98925', '98929')]
    #[PublicAttribute(true)]
    case OSTEOPATHIC_MANIPULATIVE = 27;

    #[NameAttribute('Chiropractic Manipulative Treatment Diagnoses')]
    #[RangeAttribute('98940', '98943')]
    #[PublicAttribute(true)]
    case CHIROPRACTIC_MANIPULATIVE = 28;

    #[NameAttribute('Education and Training for Patient Self-Management')]
    #[RangeAttribute('98960', '98962')]
    #[PublicAttribute(true)]
    case EDUCATION_AND_TRAINING = 29;

    #[NameAttribute('Non-Face-to-Face Nonphysician Services')]
    #[RangeAttribute('98966', '98981')]
    #[PublicAttribute(true)]
    case NON_FACE_TO_FACE = 30;

    #[NameAttribute('Special Services, Diagnoses and Reports')]
    #[RangeAttribute('99000', '99091')]
    #[PublicAttribute(true)]
    case SPECIAL_SERVICES = 31;

    #[NameAttribute('Qualifying Circumstances for Anesthesia')]
    #[RangeAttribute('99100', '99140')]
    #[PublicAttribute(true)]
    case QUALIFYING_CIRCUMSTANCES = 32;

    #[NameAttribute('Moderate (Conscious) Sedation')]
    #[RangeAttribute('99151', '99157')]
    #[PublicAttribute(true)]
    case MODERATE_SEDATION = 33;

    #[NameAttribute('Other Medicine Services and Diagnoses')]
    #[RangeAttribute('99170', '99199')]
    #[PublicAttribute(true)]
    case OTHER_MEDICINE = 34;

    #[NameAttribute('Home Health Diagnoses and Services')]
    #[RangeAttribute('99500', '99602')]
    #[PublicAttribute(true)]
    case HOME_HEALTH = 35;

    #[NameAttribute('Medication Therapy Management Services')]
    #[RangeAttribute('99605', '99607')]
    #[PublicAttribute(true)]
    case MEDICATION_THERAPY = 36;
}
