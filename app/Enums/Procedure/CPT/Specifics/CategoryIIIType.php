<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasColorAttributes;

enum CategoryIIIType: int implements TypeInterface
{
    use HasColorAttributes;

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

    // Female Voiding Prosthesis Procedures
    // Wound Imaging for Bacterial Presence
    // Irreversible Electroporation Ablation Procedures
    // Transdermal GFR Measurement and Monitoring
    // Eye Imaging Procedures (Remote)
    // Remote Monitoring of Pulmonary System
    // Magnetic Resonance Spectroscopy Imaging
    // Cardiac Implantation and Replacement Procedures
    // Procedures Performed on Eyes
    // Procedures Performed on Prostate
    // Endovascular Lower Limb Procedure
    // Trabeculostomy Procedure by Laser (Ab Interno)
    // Automated Analysis of Coronary Atherosclerotic plaque for CAD

    // Percutaneous Lumbar Intravertebral Disc Injection Procedure
    // Hyperspectral Imaging Measurement of Hemoglobin
    // Transcatheter Ultrasound Nerve Ablation Procedure
    // CT Breast (with/without Contrast)
    // CSF Shunt Analysis
    // Spectroscopy Studies of Flap or Wound
    // Transcatheter Implantation and Removal Procedures
    // Magnetic Gastropexy with Gastrostomy Tube Insertion Procedure
    // Quantitative Magnetic Resonance Tissue Composition Analysis
    // Cardiac Rhythm Monitor System Evaluation

    // Transnasal EGD and Capsule Endoscopy Procedures
    // Transperineal Prostate Ablation Through Laser
    // Vertebral Body Tethering Procedures
    // Impedance Spectroscopy and Intracoronary Infusion Procedures
    // Drug-Eluting Implant Procedures in Eye
    // Scalp Cooling Procedures
    // Donor Hysterectomy Including Preservation Procedures
    // Uterine Allograft Preparation and Reconstruction Procedures Prior to Transplantation
    // Anterior Segment Aqueous Drainage Device Insertion Procedure
    // Endovaginal Cryogen-cooled Procedure for Urinary Incontinence

    // Benign Thyroid Nodule Ablation Procedure
    // Insertion, Replacement, Repositioning, Removal and Evaluation of Diaphragmatic Stimulation System and Leads
    // Malignant Hepatocellular Histotripsy Procedure
    // Treatment of Amblyopia using Online Digital Program
    // Quantitative Ultrasound Tissue Characterization
    // Automated Analysis of Vertebral Fracture
    // Therapeutic Ultrafiltration Procedure
    // Comprehensive Full Body 3D Kinetic Motion Analysis

    // 3-dimensional Imaging and Reconstruction of Breast or Axillary Lymph Node Tissue
    // Mapping of Pacemaker or Pacing Cardioverter-Defibrillator Leads
    // Quantitative Magnetic Resonance for Analysis of Tissue Composition
    // Posterior Chamber Injection Procedure
    // Molecular Fluorescent Imaging of Suspicious Nevus
    // Remote Treatment of Amblyopia
    // Subchondral Bone Defect Injection Procedure
    // Intradermal Immunotherapy
    // Noninvasive Arterial Plaque Analysis
    // Laser Ablation for BPH

    // Coronary Intravascular Lithotripsy (IVL) Procedure
    // Coronary Artery Disease (CAD) Risk Score Analysis
    // ARPC Therapy For Partial Thickness Rotator Cuff Tear
    // Posterior Lumbar Vertebral Joint Replacement Procedure
    // Percutaneous Cranial Nerves Stimulation
    // Tissue Characterization by Quantitative CT
    // Quantitative Magnetic Resonance Cholangiopancreatography (QMRCP) Procedure
    // Vestibular Device Procedures with Analysis and Programming

    // Laser Trabeculotomy with OCT
    // AI-Based Facial Phenotype Analysis
    // Immunotherapy Administration With Electroporation
    // Remote Body And Limb Kinematic Measurement-Based Therapy
    // Intraoperative Radiation Therapy Procedure
    // Colonic Lavage with Insertion Of Rectal Catheter Procedure
    // Xenograft Implantation Procedure
    // Prostate Ablation Procedures including Planning
    // Remote Insulin Dose Calculation and Monitoring System
    // Myocardial Perfusion Imaging Procedure

    // Vertebral Fracture Risk Assessment
    // Bioprosthetic Valve Insertion Procedure
    // Cardiac Radioablation Procedure for Arrhythmia
    // Stem Cell Injection Procedures for Perianal Fistula Treatment
    // Bone Strength and Fracture-Risk Assessment
    // Digital Pathology Digitization Procedures
    // Risk-Based Assessment for Cardiac Dysfunction
    // Transcutaneous Magnetic Stimulation of Peripheral Nerve
    // Virtual Reality Technology Services

    // Sacroiliac Joint Arthrodesis Procedure
    // Intra-Brain Hypothermia Induction Procedure
    // Pressure-Sensing Epidural Guidance System
    // Inertial Measurement Units for Clinical Movement Analysis
    // Gastrointestinal Myoelectrical Activity Study
    // Fecal Microbiota Transplantation Procedure
    // Bronchoscopy with Radiofrequency Destruction of the Pulmonary Nerves
    // Transcutaneous Auricular Neurostimulation Procedure
}
