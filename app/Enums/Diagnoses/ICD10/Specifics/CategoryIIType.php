<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Malignant neoplasms of lip, oral cavity and pharynx')]
    #[RangeAttribute('C00', 'C14')]
    #[PublicAttribute(true)]
    case LIP_ORAL_PHARYNX = 1;

    #[NameAttribute('Malignant neoplasms of digestive organs')]
    #[RangeAttribute('C15', 'C26')]
    #[PublicAttribute(true)]
    case DIGESTIVE_ORGANS = 2;

    #[NameAttribute('Malignant neoplasms of respiratory and intrathoracic organs')]
    #[RangeAttribute('C30', 'C39')]
    #[PublicAttribute(true)]
    case RESPIRATORY_INTRATHORACIC = 3;

    #[NameAttribute('Malignant neoplasms of bone and articular cartilage')]
    #[RangeAttribute('C40', 'C41')]
    #[PublicAttribute(true)]
    case BONE_ARTICULAR_CARTILAGE = 4;

    #[NameAttribute('Melanoma and other malignant neoplasms of skin')]
    #[RangeAttribute('C43', 'C44')]
    #[PublicAttribute(true)]
    case SKIN = 5;

    #[NameAttribute('Malignant neoplasms of mesothelial and soft tissue')]
    #[RangeAttribute('C45', 'C49')]
    #[PublicAttribute(true)]
    case MESOTHELIAL_SOFT_TISSUE = 6;

    #[NameAttribute('Malignant neoplasms of breast')]
    #[RangeAttribute('C50', 'C50')]
    #[PublicAttribute(true)]
    case BREAST = 7;

    #[NameAttribute('Malignant neoplasms of female genital organs')]
    #[RangeAttribute('C51', 'C58')]
    #[PublicAttribute(true)]
    case FEMALE_GENITAL_ORGANS = 8;

    #[NameAttribute('Malignant neoplasms of male genital organs')]
    #[RangeAttribute('C60', 'C63')]
    #[PublicAttribute(true)]
    case MALE_GENITAL_ORGANS = 9;

    #[NameAttribute('Malignant neoplasms of urinary tract')]
    #[RangeAttribute('C64', 'C68')]
    #[PublicAttribute(true)]
    case URINARY_TRACT = 10;

    #[NameAttribute('Malignant neoplasms of eye, brain and other parts of central nervous system')]
    #[RangeAttribute('C69', 'C72')]
    #[PublicAttribute(true)]
    case EYE_BRAIN_CNS = 11;

    #[NameAttribute('Malignant neoplasms of thyroid and other endocrine glands')]
    #[RangeAttribute('C73', 'C75')]
    #[PublicAttribute(true)]
    case THYROID_ENDOCRINE_GLANDS = 12;

    #[NameAttribute('Malignant neoplasms of ill-defined, other secondary and unspecified sites')]
    #[RangeAttribute('C76', 'C80')]
    #[PublicAttribute(true)]
    case ILL_DEFINED_SECONDARY_UNSPECIFIED = 13;

    #[NameAttribute('Malignant neuroendocrine tumors')]
    #[RangeAttribute('C7A', 'C7A')]
    #[PublicAttribute(true)]
    case NEUROENDOCRINE_TUMORS = 14;

    #[NameAttribute('Secondary neuroendocrine tumors')]
    #[RangeAttribute('C7B', 'C7B')]
    #[PublicAttribute(true)]
    case SECONDARY_NEUROENDOCRINE_TUMORS = 15;

    #[NameAttribute('Malignant neoplasms of lymphoid, hematopoietic and related tissue')]
    #[RangeAttribute('C81', 'C96')]
    #[PublicAttribute(true)]
    case LYMPHOID_HEMATOPOIETIC_TISSUE = 16;

    #[NameAttribute('In situ neoplasms')]
    #[RangeAttribute('D00', 'D09')]
    #[PublicAttribute(true)]
    case IN_SITU_NEOPLASMS = 17;

    #[NameAttribute('Benign neoplasms, except benign neuroendocrine tumors')]
    #[RangeAttribute('D10', 'D36')]
    #[PublicAttribute(true)]
    case BENIGN_NEOPLASMS_TUMORS = 18;

    #[NameAttribute('Neoplasms of uncertain behavior, polycythemia vera and myelodysplastic syndromes')]
    #[RangeAttribute('D37', 'D48')]
    #[PublicAttribute(true)]
    case UNCERTAIN_BEHAVIOR_POLYCYTHEMIA_VERA_MYELODYSPLASTIC_SYNDROMES = 19;

    #[NameAttribute('Benign neuroendocrine tumors')]
    #[RangeAttribute('D3A', 'D3A')]
    #[PublicAttribute(true)]
    case BENIGN_NEUROENDOCRINE_TUMORS = 20;

    #[NameAttribute('Neoplasms of unspecified behavior')]
    #[RangeAttribute('D49', 'D49')]
    #[PublicAttribute(true)]
    case UNSPECIFIED_BEHAVIOR = 21;
}
