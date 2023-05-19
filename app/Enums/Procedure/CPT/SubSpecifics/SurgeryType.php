<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum SurgeryType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('General Surgical Procedures')]
    #[PublicAttribute(true)]
    case GENERAL_PROCEDURES = 1;

    #[NameAttribute('Surgical Procedures on the Integumentary System')]
    #[PublicAttribute(true)]
    case INTEGUMENTARY_SYSTEM = 2;

    #[NameAttribute('Surgical Procedures on the Musculoskeletal System')]
    #[PublicAttribute(true)]
    case MUSCULOSKELETAL_SYSTEM = 3;

    #[NameAttribute('Surgical Procedures on the Respiratory System')]
    #[PublicAttribute(true)]
    case RESPIRATORY_SYSTEM = 4;

    #[NameAttribute('Surgical Procedures on the Cardiovascular System')]
    #[PublicAttribute(true)]
    case CARDIOVASCULAR_SYSTEM = 5;

    #[NameAttribute('Surgical Procedures on the Hemic and Lymphatic Systems')]
    #[PublicAttribute(true)]
    case HEMIC_AND_LYMPHATIC_SYSTEMS = 6;

    #[NameAttribute('Surgical Procedures on the Mediastinum and Diaphragm')]
    #[PublicAttribute(true)]
    case MEDIASTINUM_AND_DIAPHRAGM = 7;

    #[NameAttribute('Surgical Procedures on the Digestive System')]
    #[PublicAttribute(true)]
    case DIGESTIVE_SYSTEM = 8;

    #[NameAttribute('Surgical Procedures on the Urinary System')]
    #[PublicAttribute(true)]
    case URINARY_SYSTEM = 9;

    #[NameAttribute('Surgical Procedures on the Male Genital System')]
    #[PublicAttribute(true)]
    case MALE_GENITAL_SYSTEM = 10;

    #[NameAttribute('Reproductive System Procedures')]
    #[PublicAttribute(true)]
    case REPRODUCTIVE_SYSTEM = 11;

    #[NameAttribute('Intersex Surgery')]
    #[PublicAttribute(true)]
    case INTERSEX_SURGERY = 12;

    #[NameAttribute('Surgical Procedures on the Female Genital System')]
    #[PublicAttribute(true)]
    case FEMALE_GENITAL_SYSTEM = 13;

    #[NameAttribute('Surgical Procedures for Maternity Care and Delivery')]
    #[PublicAttribute(true)]
    case MATERNITY_CARE_AND_DELIVERY = 14;

    #[NameAttribute('Surgical Procedures on the Endocrine System')]
    #[PublicAttribute(true)]
    case ENDOCRINE_SYSTEM = 15;

    #[NameAttribute('Surgical Procedures on the Nervous System')]
    #[PublicAttribute(true)]
    case NERVOUS_SYSTEM = 16;

    #[NameAttribute('Surgical Procedures on the Eye and Ocular Adnexa')]
    #[PublicAttribute(true)]
    case EYE_AND_OCULAR_ADNEXA = 17;

    #[NameAttribute('Surgical Procedures on the Auditory System')]
    #[PublicAttribute(true)]
    case AUDITORY_SYSTEM = 18;

    #[NameAttribute('Operating Microscope Procedures')]
    #[PublicAttribute(true)]
    case OPERATING_MICROSCOPE_PROCEDURES = 19;
}
