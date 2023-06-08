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

enum SurgeryType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('General Surgical Procedures')]
    #[RangeAttribute('10004', '10021')]
    #[PublicAttribute(true)]
    case GENERAL_PROCEDURES = 1;

    #[NameAttribute('Surgical Procedures on the Integumentary System')]
    #[RangeAttribute('10030', '19499')]
    #[PublicAttribute(true)]
    case INTEGUMENTARY_SYSTEM = 2;

    #[NameAttribute('Surgical Procedures on the Musculoskeletal System')]
    #[RangeAttribute('20100', '29999')]
    #[PublicAttribute(true)]
    case MUSCULOSKELETAL_SYSTEM = 3;

    #[NameAttribute('Surgical Procedures on the Respiratory System')]
    #[RangeAttribute('30000', '32999')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SYSTEM = 4;

    #[NameAttribute('Surgical Procedures on the Cardiovascular System')]
    #[RangeAttribute('33016', '37799')]
    #[PublicAttribute(true)]
    case CARDIOVASCULAR_SYSTEM = 5;

    #[NameAttribute('Surgical Procedures on the Hemic and Lymphatic Systems')]
    #[RangeAttribute('38100', '38999')]
    #[PublicAttribute(true)]
    case HEMIC_AND_LYMPHATIC_SYSTEMS = 6;

    #[NameAttribute('Surgical Procedures on the Mediastinum and Diaphragm')]
    #[RangeAttribute('39000', '39599')]
    #[PublicAttribute(true)]
    case MEDIASTINUM_AND_DIAPHRAGM = 7;

    #[NameAttribute('Surgical Procedures on the Digestive System')]
    #[RangeAttribute('40490', '49999')]
    #[PublicAttribute(true)]
    case DIGESTIVE_SYSTEM = 8;

    #[NameAttribute('Surgical Procedures on the Urinary System')]
    #[RangeAttribute('50010', '53899')]
    #[PublicAttribute(true)]
    case URINARY_SYSTEM = 9;

    #[NameAttribute('Surgical Procedures on the Male Genital System')]
    #[RangeAttribute('54000', '55899')]
    #[PublicAttribute(true)]
    case MALE_GENITAL_SYSTEM = 10;

    #[NameAttribute('Reproductive System Procedures')]
    #[RangeAttribute('55920', '55920')]
    #[PublicAttribute(true)]
    case REPRODUCTIVE_SYSTEM = 11;

    #[NameAttribute('Intersex Surgery')]
    #[RangeAttribute('55970', '55980')]
    #[PublicAttribute(true)]
    case INTERSEX_SURGERY = 12;

    #[NameAttribute('Surgical Procedures on the Female Genital System')]
    #[RangeAttribute('56405', '58999')]
    #[PublicAttribute(true)]
    case FEMALE_GENITAL_SYSTEM = 13;

    #[NameAttribute('Surgical Procedures for Maternity Care and Delivery')]
    #[RangeAttribute('59000', '59899')]
    #[PublicAttribute(true)]
    case MATERNITY_CARE_AND_DELIVERY = 14;

    #[NameAttribute('Surgical Procedures on the Endocrine System')]
    #[RangeAttribute('60000', '60699')]
    #[PublicAttribute(true)]
    case ENDOCRINE_SYSTEM = 15;

    #[NameAttribute('Surgical Procedures on the Nervous System')]
    #[RangeAttribute('61000', '64999')]
    #[PublicAttribute(true)]
    case NERVOUS_SYSTEM = 16;

    #[NameAttribute('Surgical Procedures on the Eye and Ocular Adnexa')]
    #[RangeAttribute('65091', '68899')]
    #[PublicAttribute(true)]
    case EYE_AND_OCULAR_ADNEXA = 17;

    #[NameAttribute('Surgical Procedures on the Auditory System')]
    #[RangeAttribute('69000', '69979')]
    #[PublicAttribute(true)]
    case AUDITORY_SYSTEM = 18;

    #[NameAttribute('Operating Microscope Procedures')]
    #[RangeAttribute('69990', '69990')]
    #[PublicAttribute(true)]
    case OPERATING_MICROSCOPE_PROCEDURES = 19;
}
