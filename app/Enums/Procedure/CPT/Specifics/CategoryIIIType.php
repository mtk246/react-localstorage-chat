<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIIIType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Various Services - Category III Codes')]
    #[PublicAttribute(true)]
    case VARIOUS_SERVICES = 1;

    #[NameAttribute('Atherectomy (Open or Percutaneous) for Supra-Inguinal Arteries and Other Undefined Category Codes')]
    #[PublicAttribute(true)]
    case ATHERECTOMY = 2;

    #[NameAttribute('Imaging, Testing, Implantation and Other Services')]
    #[PublicAttribute(true)]
    case IMAGING = 3;

    #[NameAttribute('Adaptive Behavior Assessments')]
    #[PublicAttribute(true)]
    case ADAPTIVE_BEHAVIOR = 4;

    #[NameAttribute('Other Procedures and Assessments')]
    #[PublicAttribute(true)]
    case OTHER_PROCEDURES = 5;

    #[NameAttribute('Pacemaker - Leadless and Pocketless System')]
    #[PublicAttribute(true)]
    case PACEMAKER = 6;

    #[NameAttribute('Phrenic Nerve Stimulation System Procedures')]
    #[PublicAttribute(true)]
    case PHRENIC_NERVE = 7;

    #[NameAttribute('Imaging, Evaluation, Programming and Recording Procedures')]
    #[PublicAttribute(true)]
    case IMAGING_EVALUATION = 8;

    #[NameAttribute('Laser Ablation Procedures')]
    #[PublicAttribute(true)]
    case LASER_ABLATION = 9;

    #[NameAttribute('Blood Products Transfusion Procedure')]
    #[PublicAttribute(true)]
    case BLOOD_PRODUCTS = 10;

    #[NameAttribute('Cardiac Diagnostic Imaging and Surgical Procedures')]
    #[PublicAttribute(true)]
    case CARDIAC_DIAGNOSTIC = 11;

    #[NameAttribute('Diagnostic Procedures')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC = 12;

    #[NameAttribute('Behavior Analysis')]
    #[PublicAttribute(true)]
    case BEHAVIOR_ANALYSIS = 13;

    #[NameAttribute('Cellular Regeneration, Evaluation Study and Ablation Procedures')]
    #[PublicAttribute(true)]
    case CELLULAR_REGENERATION = 14;

    #[NameAttribute('Organ Transplantation Procedures')]
    #[PublicAttribute(true)]
    case ORGAN_TRANSPLANTATION = 15;

    #[NameAttribute('Cystourethroscopy with Therapeutic Drug Delivery Procedure ')]
    #[PublicAttribute(true)]
    case CYSTOURETHROSCOPY = 16;

    #[NameAttribute('Human Papillomavirus (HPV) Analysis')]
    #[PublicAttribute(true)]
    case HUMAN_PAPILLOMAVIRUS = 17;

    #[NameAttribute('Coronary Artery Disease (CAD) Analysis')]
    #[PublicAttribute(true)]
    case CORONARY_ARTERY_DISEASE = 18;

    #[NameAttribute('Other Diagnostic and Therapeutic Procedures')]
    #[PublicAttribute(true)]
    case OTHER_DIAGNOSTIC = 19;

    #[NameAttribute('Vision Studies, Implants and Therapies')]
    #[PublicAttribute(true)]
    case VISION_STUDIES = 20;

    #[NameAttribute('Cardiac Device Implantation, Analysis and Removal Procedures')]
    #[PublicAttribute(true)]
    case CARDIAC_DEVICE = 21;

    #[NameAttribute('Ablation Procedures')]
    #[PublicAttribute(true)]
    case ABLATION = 22;

    #[NameAttribute('Intracardiac Ischemia Monitoring Procedures')]
    #[PublicAttribute(true)]
    case INTRACARDIAC_ISCHEMIA = 23;

    #[NameAttribute('Movement Disorder Analysis')]
    #[PublicAttribute(true)]
    case MOVEMENT_DISORDER = 24;

    #[NameAttribute('Cellular Therapy Procedures')]
    #[PublicAttribute(true)]
    case CELLULAR_THERAPY = 25;

    #[NameAttribute('Cardiac Muscle Imaging')]
    #[PublicAttribute(true)]
    case CARDIAC_MUSCLE = 26;

    #[NameAttribute('Cardiac Valve Repair Procedures')]
    #[PublicAttribute(true)]
    case CARDIAC_VALVE = 27;

    #[NameAttribute('Radiofrequency Spectrometry Assessment and Bone Quality Testing Procedures')]
    #[PublicAttribute(true)]
    case RADIOFREQUENCY_SPECTROMETRY = 28;

    #[NameAttribute('Laser Therapy and Implant Procedures')]
    #[PublicAttribute(true)]
    case LASER_THERAPY = 29;

    #[NameAttribute('Bone Strength And Fracture Risk Assessment')]
    #[PublicAttribute(true)]
    case BONE_STRENGTH = 30;

    #[NameAttribute('Computed Tomography Analysis')]
    #[PublicAttribute(true)]
    case COMPUTED_TOMOGRAPHY = 31;

    #[NameAttribute('Anatomic Model And Guide Creation')]
    #[PublicAttribute(true)]
    case ANATOMIC_MODEL = 32;

    #[NameAttribute('Procedures on Eye Glands')]
    #[PublicAttribute(true)]
    case EYE_GLANDS = 33;

    #[NameAttribute('Chemo Drug Essay, Implant and Other Procedures')]
    #[PublicAttribute(true)]
    case CHEMO_DRUG = 34;

    #[NameAttribute('Cardiac Procedures with Evaluation on Valves and ICD System')]
    #[PublicAttribute(true)]
    case CARDIAC_PROCEDURES = 35;

    #[NameAttribute('Ablation Procedures')]
    #[PublicAttribute(true)]
    case ABLATION_2 = 36;

    #[NameAttribute('Procedures Performed on Ear')]
    #[PublicAttribute(true)]
    case EAR = 37;

    #[NameAttribute('Islet Cell Transplant Procedure')]
    #[PublicAttribute(true)]
    case ISLET_CELL = 38;

    #[NameAttribute('Neurostimulation Procedures')]
    #[PublicAttribute(true)]
    case NEUROSTIMULATION = 39;

    #[NameAttribute('Health And Well-Being Coaching')]
    #[PublicAttribute(true)]
    case HEALTH_WELL_BEING = 40;

    #[NameAttribute('Limb Lengthening Procedure')]
    #[PublicAttribute(true)]
    case LIMB_LENGTHENING = 41;
}
