<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

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

    #[NameAttribute('Drug Assay Procedures')]
    #[RangeAttribute('80305', '80377')]
    #[PublicAttribute(true)]
    case DRUG_ASSAY_PROCEDURES = 3;

    #[NameAttribute('Evocative/Suppression Testing Procedures')]
    #[RangeAttribute('80400', '80439')]
    #[PublicAttribute(true)]
    case EVOCATIVE_SUPPRESSION_TESTING_PROCEDURES = 4;

    #[NameAttribute('Clinical Pathology Consultations')]
    #[RangeAttribute('80503', '80506')]
    #[PublicAttribute(true)]
    case CLINICAL_PATHOLOGY_CONSULTATIONS = 5;

    #[NameAttribute('Urinalysis Procedures')]
    #[RangeAttribute('81000', '81099')]
    #[PublicAttribute(true)]
    case URINALYSIS_PROCEDURES = 6;

    #[NameAttribute('Molecular Pathology Procedures')]
    #[RangeAttribute('81105', '81479')]
    #[PublicAttribute(true)]
    case MOLECULAR_PATHOLOGY_PROCEDURES = 7;

    #[NameAttribute('Genomic Sequencing Procedures and Other Molecular Multianalyte Assays')]
    #[RangeAttribute('81410', '81471')]
    #[PublicAttribute(true)]
    case GENOMIC_SEQUENCING_PROCEDURES_AND_OTHER_MOLECULAR_MULTIANALYTE_ASSAYS = 8;

    #[NameAttribute('Multianalyte Assays with Algorithmic Analyses')]
    #[RangeAttribute('81490', '81599')]
    #[PublicAttribute(true)]
    case MULTYANALYTE = 9;

    #[NameAttribute('Chemistry Procedures')]
    #[RangeAttribute('82009', '84999')]
    #[PublicAttribute(true)]
    case CHEMISTRY = 10;

    #[NameAttribute('Hematology and Coagulation Procedures')]
    #[RangeAttribute('85002', '85999')]
    #[PublicAttribute(true)]
    case HEMATOLOGY_AND_COAGULATION = 11;

    #[NameAttribute('Immunology Procedures')]
    #[RangeAttribute('86000', '86849')]
    #[PublicAttribute(true)]
    case IMMUNOLOGY = 12;

    #[NameAttribute('Transfusion Medicine Procedures')]
    #[RangeAttribute('86850', '86999')]
    #[PublicAttribute(true)]
    case TRANSFUSION_MEDICINE = 13;

    #[NameAttribute('Microbiology Procedures')]
    #[RangeAttribute('87003', '87999')]
    #[PublicAttribute(true)]
    case MICROBIOLOGY = 14;

    #[NameAttribute('Anatomic Pathology Procedures')]
    #[RangeAttribute('88000', '88099')]
    #[PublicAttribute(true)]
    case ANATOMIC_PATHOLOGY = 15;

    #[NameAttribute('Cytopathology Procedures')]
    #[RangeAttribute('88104', '88199')]
    #[PublicAttribute(true)]
    case CYTOPATHOLOGY = 16;

    #[NameAttribute('Cytogenetic Studies')]
    #[RangeAttribute('88230', '88299')]
    #[PublicAttribute(true)]
    case CYTOGENETIC = 17;

    #[NameAttribute('Surgical Pathology Procedures')]
    #[RangeAttribute('88300', '88399')]
    #[PublicAttribute(true)]
    case SURGICAL_PATHOLOGY = 18;

    #[NameAttribute('In Vivo (eg, Transcutaneous) Laboratory Procedures')]
    #[RangeAttribute('88720', '88749')]
    #[PublicAttribute(true)]
    case IN_VIVO = 19;

    #[NameAttribute('Other Pathology and Laboratory Procedures')]
    #[RangeAttribute('89049', '89240')]
    #[PublicAttribute(true)]
    case OTHER = 20;

    #[NameAttribute('Reproductive Medicine Procedures')]
    #[RangeAttribute('89250', '89398')]
    #[PublicAttribute(true)]
    case REPRODUCTIVE = 21;
}
