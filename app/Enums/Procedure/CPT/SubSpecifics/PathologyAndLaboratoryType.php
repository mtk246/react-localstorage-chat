<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum PathologyAndLaboratoryType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Organ or Disease Oriented Panels')]
    #[PublicAttribute(true)]
    case ORGAN_OR_DISEASE = 1;

    #[NameAttribute('Therapeutic Drug Assays')]
    #[PublicAttribute(true)]
    case THERAPEUTIC_DRUG_ASSAYS = 2;

    #[NameAttribute('Drug Assay Procedures')]
    #[PublicAttribute(true)]
    case DRUG_ASSAY_PROCEDURES = 3;

    #[NameAttribute('Evocative/Suppression Testing Procedures')]
    #[PublicAttribute(true)]
    case EVOCATIVE_SUPPRESSION_TESTING_PROCEDURES = 4;

    #[NameAttribute('Clinical Pathology Consultations')]
    #[PublicAttribute(true)]
    case CLINICAL_PATHOLOGY_CONSULTATIONS = 5;

    #[NameAttribute('Urinalysis Procedures')]
    #[PublicAttribute(true)]
    case URINALYSIS_PROCEDURES = 6;

    #[NameAttribute('Molecular Pathology Procedures')]
    #[PublicAttribute(true)]
    case MOLECULAR_PATHOLOGY_PROCEDURES = 7;

    #[NameAttribute('Genomic Sequencing Procedures and Other Molecular Multianalyte Assays')]
    #[PublicAttribute(true)]
    case GENOMIC_SEQUENCING_PROCEDURES_AND_OTHER_MOLECULAR_MULTIANALYTE_ASSAYS = 8;

    #[NameAttribute('Multianalyte Assays with Algorithmic Analyses')]
    #[PublicAttribute(true)]
    case MULTYANALYTE = 9;

    #[NameAttribute('Chemistry Procedures')]
    #[PublicAttribute(true)]
    case CHEMISTRY = 10;

    #[NameAttribute('Hematology and Coagulation Procedures')]
    #[PublicAttribute(true)]
    case HEMATOLOGY_AND_COAGULATION = 11;

    #[NameAttribute('Immunology Procedures')]
    #[PublicAttribute(true)]
    case IMMUNOLOGY = 12;

    #[NameAttribute('Transfusion Medicine Procedures')]
    #[PublicAttribute(true)]
    case TRANSFUSION_MEDICINE = 13;

    #[NameAttribute('Microbiology Procedures')]
    #[PublicAttribute(true)]
    case MICROBIOLOGY = 14;

    #[NameAttribute('Anatomic Pathology Procedures')]
    #[PublicAttribute(true)]
    case ANATOMIC_PATHOLOGY = 15;

    #[NameAttribute('Cytopathology Procedures')]
    #[PublicAttribute(true)]
    case CYTOPATHOLOGY = 16;

    #[NameAttribute('Cytogenetic Studies')]
    #[PublicAttribute(true)]
    case CYTOGENETIC = 17;

    #[NameAttribute('Surgical Pathology Procedures')]
    #[PublicAttribute(true)]
    case SURGICAL_PATHOLOGY = 18;

    #[NameAttribute('In Vivo (eg, Transcutaneous) Laboratory Procedures')]
    #[PublicAttribute(true)]
    case IN_VIVO = 19;

    #[NameAttribute('Other Pathology and Laboratory Procedures')]
    #[PublicAttribute(true)]
    case OTHER = 20;

    #[NameAttribute('Reproductive Medicine Procedures')]
    #[PublicAttribute(true)]
    case REPRODUCTIVE = 21;
}
