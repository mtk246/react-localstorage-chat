<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum MedicineAndProcedureType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Immune Globulins, Serum or Recombinant Products')]
    #[PublicAttribute(true)]
    case IMMNUME_GLOBULINS = 1;

    #[NameAttribute('Immunization Administration for Vaccines/Toxoids')]
    #[PublicAttribute(true)]
    case IMMUNIZATION_ADMINISTRATION = 2;

    #[NameAttribute('Vaccines, Toxoids')]
    #[PublicAttribute(true)]
    case VACCINES = 3;

    #[NameAttribute('Psychiatry Services and Procedures')]
    #[PublicAttribute(true)]
    case PSYCHIATRY = 4;

    #[NameAttribute('Biofeedback Services and Procedures')]
    #[PublicAttribute(true)]
    case BIOFEEDBACK = 5;

    #[NameAttribute('Dialysis Services and Procedures')]
    #[PublicAttribute(true)]
    case DIALYSIS = 6;

    #[NameAttribute('Gastroenterology Procedures')]
    #[PublicAttribute(true)]
    case GASTROENTEROLOGY = 7;

    #[NameAttribute('Ophthalmology Services and Procedures')]
    #[PublicAttribute(true)]
    case OPHTHALMOLOGY = 8;

    #[NameAttribute('Special Otorhinolaryngologic Services and Procedures')]
    #[PublicAttribute(true)]
    case OTORHINOLARYNGOLOGY = 9;

    #[NameAttribute('Cardiovascular Procedures')]
    #[PublicAttribute(true)]
    case CARDIOVASCULAR = 10;

    #[NameAttribute('Non-Invasive Vascular Diagnostic Studies')]
    #[PublicAttribute(true)]
    case VASCULAR = 11;

    #[NameAttribute('Pulmonary Procedures')]
    #[PublicAttribute(true)]
    case PULMONARY = 12;

    #[NameAttribute('Allergy and Clinical Immunology Procedures')]
    #[PublicAttribute(true)]
    case ALLERGY = 13;

    #[NameAttribute('Endocrinology Services')]
    #[PublicAttribute(true)]
    case ENDOCRINOLOGY = 14;

    #[NameAttribute('Neurology and Neuromuscular Procedures')]
    #[PublicAttribute(true)]
    case NEUROLOGY = 15;

    #[NameAttribute('Medical Genetics and Genetic Counseling Services')]
    #[PublicAttribute(true)]
    case MEDICAL_GENETICS = 16;

    #[NameAttribute('Central Nervous System Assessments/Tests (eg, Neuro-Cognitive, Mental Status, Speech Testing)')]
    #[PublicAttribute(true)]
    case CENTRAL_NERVOUS_SYSTEM = 17;

    #[NameAttribute('Health Behavior Assessment and Intervention Procedures')]
    #[PublicAttribute(true)]
    case HEALTH_BEHAVIOR = 18;

    #[NameAttribute('Behavior Management Services')]
    #[PublicAttribute(true)]
    case BEHAVIOR_MANAGEMENT = 19;

    #[NameAttribute('Hydration, Therapeutic, Prophylactic, Diagnostic Injections and Infusions, and Chemotherapy and Other Highly Complex Drug or Highly Complex Biologic Agent Administration')]
    #[PublicAttribute(true)]
    case HYDRATION = 20;

    #[NameAttribute('Photodynamic Therapy Procedures')]
    #[PublicAttribute(true)]
    case PHOTODYNAMIC_THERAPY = 21;

    #[NameAttribute('Special Dermatological Procedures')]
    #[PublicAttribute(true)]
    case SPECIAL_DERMATOLOGICAL = 22;

    #[NameAttribute('Physical Medicine and Rehabilitation Evaluations')]
    #[PublicAttribute(true)]
    case PHYSICAL_MEDICINE = 23;

    #[NameAttribute('Adaptive Behavior Services')]
    #[PublicAttribute(true)]
    case ADAPTIVE_BEHAVIOR = 24;

    #[NameAttribute('Medical Nutrition Therapy Procedures')]
    #[PublicAttribute(true)]
    case MEDICAL_NUTRITION = 25;

    #[NameAttribute('Acupuncture Procedures')]
    #[PublicAttribute(true)]
    case ACUPUNCTURE = 26;

    #[NameAttribute('Osteopathic Manipulative Treatment Procedures')]
    #[PublicAttribute(true)]
    case OSTEOPATHIC_MANIPULATIVE = 27;

    #[NameAttribute('Chiropractic Manipulative Treatment Procedures')]
    #[PublicAttribute(true)]
    case CHIROPRACTIC_MANIPULATIVE = 28;

    #[NameAttribute('Education and Training for Patient Self-Management')]
    #[PublicAttribute(true)]
    case EDUCATION_AND_TRAINING = 29;

    #[NameAttribute('Non-Face-to-Face Nonphysician Services')]
    #[PublicAttribute(true)]
    case NON_FACE_TO_FACE = 30;

    #[NameAttribute('Special Services, Procedures and Reports')]
    #[PublicAttribute(true)]
    case SPECIAL_SERVICES = 31;

    #[NameAttribute('Qualifying Circumstances for Anesthesia')]
    #[PublicAttribute(true)]
    case QUALIFYING_CIRCUMSTANCES = 32;

    #[NameAttribute('Moderate (Conscious) Sedation')]
    #[PublicAttribute(true)]
    case MODERATE_SEDATION = 33;

    #[NameAttribute('Other Medicine Services and Procedures')]
    #[PublicAttribute(true)]
    case OTHER_MEDICINE = 34;

    #[NameAttribute('Home Health Procedures and Services')]
    #[PublicAttribute(true)]
    case HOME_HEALTH = 35;

    #[NameAttribute('Medication Therapy Management Services')]
    #[PublicAttribute(true)]
    case MEDICATION_THERAPY = 36;
}
