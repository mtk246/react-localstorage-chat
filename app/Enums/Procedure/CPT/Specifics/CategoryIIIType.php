<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Various Services - Category III Codes')]
    #[RangeAttribute('0042T', '0232T')]
    #[PublicAttribute(true)]
    case VARIOUS_SERVICES = 1;

    #[NameAttribute('Atherectomy (Open or Percutaneous) for Supra-Inguinal Arteries and Other Undefined Category Codes')]
    #[RangeAttribute('0234T', '0308T')]
    #[PublicAttribute(true)]
    case ATHERECTOMY = 2;

    #[NameAttribute('Imaging, Testing, Implantation and Other Services')]
    #[RangeAttribute('0329T', '0358T')]
    #[PublicAttribute(true)]
    case IMAGING = 3;

    #[NameAttribute('Adaptive Behavior Assessments')]
    #[RangeAttribute('0362T', '0373T')]
    #[PublicAttribute(true)]
    case ADAPTIVE_BEHAVIOR = 4;

    #[NameAttribute('Other Procedures and Assessments')]
    #[RangeAttribute('0378T', '0379T')]
    #[PublicAttribute(true)]
    case OTHER_PROCEDURES = 5;

    #[NameAttribute('Pacemaker - Leadless and Pocketless System')]
    #[RangeAttribute('0394T', '0422T')]
    #[PublicAttribute(true)]
    case PACEMAKER = 6;

    #[NameAttribute('Phrenic Nerve Stimulation System Procedures')]
    #[RangeAttribute('0424T', '0465T')]
    #[PublicAttribute(true)]
    case PHRENIC_NERVE = 7;

    #[NameAttribute('Imaging, Evaluation, Programming and Recording Procedures')]
    #[RangeAttribute('0469T', '0474T')]
    #[PublicAttribute(true)]
    case IMAGING_EVALUATION = 8;

    #[NameAttribute('Laser Ablation Procedures')]
    #[RangeAttribute('0479T', '0480T')]
    #[PublicAttribute(true)]
    case LASER_ABLATION = 9;

    #[NameAttribute('Blood Products Transfusion Procedure')]
    #[RangeAttribute('0481T', '0481T')]
    #[PublicAttribute(true)]
    case BLOOD_PRODUCTS = 10;

    #[NameAttribute('Cardiac Diagnostic Imaging and Surgical Procedures')]
    #[RangeAttribute('0483T', '0484T')]
    #[PublicAttribute(true)]
    case CARDIAC_DIAGNOSTIC = 11;

    #[NameAttribute('Diagnostic Procedures')]
    #[RangeAttribute('0485T', '0486T')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC = 12;

    #[NameAttribute('Behavior Analysis')]
    #[RangeAttribute('0488T', '0488T')]
    #[PublicAttribute(true)]
    case BEHAVIOR_ANALYSIS = 13;

    #[NameAttribute('Cellular Regeneration, Evaluation Study and Ablation Procedures')]
    #[RangeAttribute('0489T', '0490T')]
    #[PublicAttribute(true)]
    case CELLULAR_REGENERATION = 14;

    #[NameAttribute('Organ Transplantation Procedures')]
    #[RangeAttribute('0494T', '0496T')]
    #[PublicAttribute(true)]
    case ORGAN_TRANSPLANTATION = 15;

    #[NameAttribute('Cystourethroscopy with Therapeutic Drug Delivery Procedure ')]
    #[RangeAttribute('0499T', '0499T')]
    #[PublicAttribute(true)]
    case CYSTOURETHROSCOPY = 16;

    #[NameAttribute('Human Papillomavirus (HPV) Analysis')]
    #[RangeAttribute('0500T', '0500T')]
    #[PublicAttribute(true)]
    case HUMAN_PAPILLOMAVIRUS = 17;

    #[NameAttribute('Coronary Artery Disease (CAD) Analysis')]
    #[RangeAttribute('0501T', '0504T')]
    #[PublicAttribute(true)]
    case CORONARY_ARTERY_DISEASE = 18;

    #[NameAttribute('Other Diagnostic and Therapeutic Procedures')]
    #[RangeAttribute('0505T', '0508T')]
    #[PublicAttribute(true)]
    case OTHER_DIAGNOSTIC = 19;

    #[NameAttribute('Vision Studies, Implants and Therapies')]
    #[RangeAttribute('0509T', '0513T')]
    #[PublicAttribute(true)]
    case VISION_STUDIES = 20;

    #[NameAttribute('Cardiac Device Implantation, Analysis and Removal Procedures')]
    #[RangeAttribute('0515T', '0523T')]
    #[PublicAttribute(true)]
    case CARDIAC_DEVICE = 21;

    #[NameAttribute('Ablation Procedures')]
    #[RangeAttribute('0524T', '0524T')]
    #[PublicAttribute(true)]
    case ABLATION = 22;

    #[NameAttribute('Intracardiac Ischemia Monitoring Procedures')]
    #[RangeAttribute('0525T', '0532T')]
    #[PublicAttribute(true)]
    case INTRACARDIAC_ISCHEMIA = 23;

    #[NameAttribute('Movement Disorder Analysis')]
    #[RangeAttribute('0533T', '0536T')]
    #[PublicAttribute(true)]
    case MOVEMENT_DISORDER = 24;

    #[NameAttribute('Cellular Therapy Procedures')]
    #[RangeAttribute('0537T', '0540T')]
    #[PublicAttribute(true)]
    case CELLULAR_THERAPY = 25;

    #[NameAttribute('Cardiac Muscle Imaging')]
    #[RangeAttribute('0541T', '0542T')]
    #[PublicAttribute(true)]
    case CARDIAC_MUSCLE = 26;

    #[NameAttribute('Cardiac Valve Repair Procedures')]
    #[RangeAttribute('0543T', '0545T')]
    #[PublicAttribute(true)]
    case CARDIAC_VALVE = 27;

    #[NameAttribute('Radiofrequency Spectrometry Assessment and Bone Quality Testing Procedures')]
    #[RangeAttribute('0546T', '0547T')]
    #[PublicAttribute(true)]
    case RADIOFREQUENCY_SPECTROMETRY = 28;

    #[NameAttribute('Laser Therapy and Implant Procedures')]
    #[RangeAttribute('0552T', '0553T')]
    #[PublicAttribute(true)]
    case LASER_THERAPY = 29;

    #[NameAttribute('Bone Strength And Fracture Risk Assessment')]
    #[RangeAttribute('0554T', '0557T')]
    #[PublicAttribute(true)]
    case BONE_STRENGTH = 30;

    #[NameAttribute('Computed Tomography Analysis')]
    #[RangeAttribute('0558T', '0558T')]
    #[PublicAttribute(true)]
    case COMPUTED_TOMOGRAPHY = 31;

    #[NameAttribute('Anatomic Model And Guide Creation')]
    #[RangeAttribute('0559T', '0562T')]
    #[PublicAttribute(true)]
    case ANATOMIC_MODEL = 32;

    #[NameAttribute('Procedures on Eye Glands')]
    #[RangeAttribute('0563T', '0563T')]
    #[PublicAttribute(true)]
    case EYE_GLANDS = 33;

    #[NameAttribute('Chemo Drug Essay, Implant and Other Procedures')]
    #[RangeAttribute('0564T', '0568T')]
    #[PublicAttribute(true)]
    case CHEMO_DRUG = 34;

    #[NameAttribute('Cardiac Procedures with Evaluation on Valves and ICD System')]
    #[RangeAttribute('0569T', '0580T')]
    #[PublicAttribute(true)]
    case CARDIAC_PROCEDURES = 35;

    #[NameAttribute('Ablation Procedures')]
    #[RangeAttribute('0581T', '0582T')]
    #[PublicAttribute(true)]
    case ABLATION_2 = 36;

    #[NameAttribute('Procedures Performed on Ear')]
    #[RangeAttribute('0583T', '0583T')]
    #[PublicAttribute(true)]
    case EAR = 37;

    #[NameAttribute('Islet Cell Transplant Procedure')]
    #[RangeAttribute('0584T', '0586T')]
    #[PublicAttribute(true)]
    case ISLET_CELL = 38;

    #[NameAttribute('Neurostimulation Procedures')]
    #[RangeAttribute('0587T', '0590T')]
    #[PublicAttribute(true)]
    case NEUROSTIMULATION = 39;

    #[NameAttribute('Health And Well-Being Coaching')]
    #[RangeAttribute('0591T', '0593T')]
    #[PublicAttribute(true)]
    case HEALTH_WELL_BEING = 40;

    #[NameAttribute('Limb Lengthening Procedure')]
    #[RangeAttribute('0594T', '0594T')]
    #[PublicAttribute(true)]
    case LIMB_LENGTHENING = 41;
}
