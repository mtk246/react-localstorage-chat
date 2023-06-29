<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum PathologyAndLaboratoryType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('Organ or Disease Oriented Panels')]
    #[RangeAttribute('80047', '80081')]
    #[PublicAttribute(true)]
    case ORGAN_OR_DISEASE = 1;

    #[NameAttribute('Therapeutic Drug Assays')]
    #[RangeAttribute('80143', '80377')]
    #[PublicAttribute(true)]
    case THERAPEUTIC_DRUG_ASSAYS = 2;

    #[NameAttribute('Drug Assay Diagnoses')]
    #[RangeAttribute('80305', '80377')]
    #[PublicAttribute(true)]
    case DRUG_ASSAY_Diagnoses = 3;

    #[NameAttribute('Evocative/Suppression Testing Diagnoses')]
    #[RangeAttribute('80400', '80439')]
    #[PublicAttribute(true)]
    case EVOCATIVE_SUPPRESSION_TESTING_Diagnoses = 4;

    #[NameAttribute('Clinical Pathology Consultations')]
    #[RangeAttribute('80503', '80506')]
    #[PublicAttribute(true)]
    case CLINICAL_PATHOLOGY_CONSULTATIONS = 5;

    #[NameAttribute('Urinalysis Diagnoses')]
    #[RangeAttribute('81000', '81099')]
    #[PublicAttribute(true)]
    case URINALYSIS_Diagnoses = 6;

    #[NameAttribute('Molecular Pathology Diagnoses')]
    #[RangeAttribute('81105', '81479')]
    #[PublicAttribute(true)]
    case MOLECULAR_PATHOLOGY_Diagnoses = 7;

    #[NameAttribute('Genomic Sequencing Diagnoses and Other Molecular Multianalyte Assays')]
    #[RangeAttribute('81410', '81471')]
    #[PublicAttribute(true)]
    case GENOMIC_SEQUENCING_Diagnoses_AND_OTHER_MOLECULAR_MULTIANALYTE_ASSAYS = 8;

    #[NameAttribute('Multianalyte Assays with Algorithmic Analyses')]
    #[RangeAttribute('81490', '81599')]
    #[PublicAttribute(true)]
    case MULTYANALYTE = 9;

    #[NameAttribute('Chemistry Diagnoses')]
    #[RangeAttribute('82009', '84999')]
    #[PublicAttribute(true)]
    case CHEMISTRY = 10;

    #[NameAttribute('Hematology and Coagulation Diagnoses')]
    #[RangeAttribute('85002', '85999')]
    #[PublicAttribute(true)]
    case HEMATOLOGY_AND_COAGULATION = 11;

    #[NameAttribute('Immunology Diagnoses')]
    #[RangeAttribute('86000', '86849')]
    #[PublicAttribute(true)]
    case IMMUNOLOGY = 12;

    #[NameAttribute('Transfusion Medicine Diagnoses')]
    #[RangeAttribute('86850', '86999')]
    #[PublicAttribute(true)]
    case TRANSFUSION_MEDICINE = 13;

    #[NameAttribute('Microbiology Diagnoses')]
    #[RangeAttribute('87003', '87999')]
    #[PublicAttribute(true)]
    case MICROBIOLOGY = 14;

    #[NameAttribute('Anatomic Pathology Diagnoses')]
    #[RangeAttribute('88000', '88099')]
    #[PublicAttribute(true)]
    case ANATOMIC_PATHOLOGY = 15;

    #[NameAttribute('Cytopathology Diagnoses')]
    #[RangeAttribute('88104', '88199')]
    #[PublicAttribute(true)]
    case CYTOPATHOLOGY = 16;

    #[NameAttribute('Cytogenetic Studies')]
    #[RangeAttribute('88230', '88299')]
    #[PublicAttribute(true)]
    case CYTOGENETIC = 17;

    #[NameAttribute('Surgical Pathology Diagnoses')]
    #[RangeAttribute('88300', '88399')]
    #[PublicAttribute(true)]
    case SURGICAL_PATHOLOGY = 18;

    #[NameAttribute('In Vivo (eg, Transcutaneous) Laboratory Diagnoses')]
    #[RangeAttribute('88720', '88749')]
    #[PublicAttribute(true)]
    case IN_VIVO = 19;

    #[NameAttribute('Other Pathology and Laboratory Diagnoses')]
    #[RangeAttribute('89049', '89240')]
    #[PublicAttribute(true)]
    case OTHER = 20;

    #[NameAttribute('Reproductive Medicine Diagnoses')]
    #[RangeAttribute('89250', '89398')]
    #[PublicAttribute(true)]
    case REPRODUCTIVE = 21;
}
