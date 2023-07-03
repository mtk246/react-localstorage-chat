<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryIIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryIVType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryVType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryVIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryVIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryVIIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryIXType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXIIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXIVType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXVType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXVIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXVIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXVIIIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXIXType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXXType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXXIType;
use App\Enums\Diagnoses\ICD10\Specifics\CategoryXXIIType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements ProcedureClassificationInterface {
    
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[ColorAttribute('#FFFFFF')]
    #[NameAttribute('Certain Infectious and Parasitic Diseases')]
    #[ChildAttribute(CategoryIType::class)]
    #[RangeAttribute('A00', 'B99')]
    #[PublicAttribute(true)]
    case CATEGORY_I = 1;

    #[ColorAttribute('#FF9B95')]
    #[NameAttribute('Neoplasms')]
    #[ChildAttribute(CategoryIIType::class)]
    #[RangeAttribute('C00', 'D49' )]
    #[PublicAttribute(true)]
    case CATEGORY_II = 2;

    #[ColorAttribute('#980E04')]
    #[NameAttribute('Disease of the blood and blood-forming organs and certain disorders involving the immune mechanism')]
    #[ChildAttribute(CategoryIIIType::class)]
    #[RangeAttribute('D50', 'D89')]
    #[PublicAttribute(true)]
    case CATEGORY_III = 3;

    #[ColorAttribute('#680B05')]
    #[NameAttribute('Endocrine, Nutritional, and Metabolic Diseases')]
    #[ChildAttribute(CategoryIVType::class)]
    #[RangeAttribute('E00', 'E89')]
    #[PublicAttribute(true)]
    case CATEGORY_IV = 4;

    #[ColorAttribute('#FCC084')]
    #[NameAttribute('Mental, Behavioral and Neurodevelopmental disorders')]
    #[ChildAttribute(CategoryVType::class)]
    #[RangeAttribute('F01', 'F99')]
    #[PublicAttribute(true)]
    case CATEGORY_V = 5;

    #[ColorAttribute('#DB5200')]
    #[NameAttribute('Diseases of the Nervous System')]
    #[ChildAttribute(CategoryVIType::class)]
    #[RangeAttribute('G00', 'G99')]
    #[PublicAttribute(true)]
    case CATEGORY_VI = 6;

    #[ColorAttribute('#A13F05')]
    #[NameAttribute('Diseases of the Eye and Adnexa')]
    #[ChildAttribute(CategoryVIIType::class)]
    #[RangeAttribute('H00', 'H59')]
    #[PublicAttribute(true)]
    case CATEGORY_VII = 7;

    #[ColorAttribute('#FDFFBC')]
    #[NameAttribute('Diseases of the Ear and Mastoid Process')]
    #[ChildAttribute(CategoryVIIIType::class)]
    #[RangeAttribute('H60', 'H95')]
    #[PublicAttribute(true)]
    case CATEGORY_VIII = 8;

    #[ColorAttribute('#FBE661')]
    #[NameAttribute('Diseases of the Circulatory System')]
    #[ChildAttribute(CategoryIXType::class)]
    #[RangeAttribute('I00', 'I99')]
    #[PublicAttribute(true)]
    case CATEGORY_IX = 9;

    #[ColorAttribute('#B59D05')]
    #[NameAttribute('Diseases of the Respiratory System')]
    #[ChildAttribute(CategoryXType::class)]
    #[RangeAttribute('J00', 'J99')]
    #[PublicAttribute(true)]
    case CATEGORY_X = 10;

    #[ColorAttribute('#93F9C1')]
    #[NameAttribute('Diseases of the Digestive System')]
    #[ChildAttribute(CategoryXIType::class)]
    #[RangeAttribute('K00', 'K95')]
    #[PublicAttribute(true)]
    case CATEGORY_XI = 11;

    #[ColorAttribute('#1B6D49')]
    #[NameAttribute('Diseases of the Skin and Subcutaneous Tissue')]
    #[ChildAttribute(CategoryXIIType::class)]
    #[RangeAttribute('L00', 'L99')]
    #[PublicAttribute(true)]
    case CATEGORY_XII = 12;

    #[ColorAttribute('#024025')]
    #[NameAttribute('Diseases of the Musculoskeletal System and Connective Tissue')]
    #[ChildAttribute(CategoryXIIIType::class)]
    #[RangeAttribute('M00', 'M99')]
    #[PublicAttribute(true)]
    case CATEGORY_XIII = 13;

    #[ColorAttribute('#B7EDFF')]
    #[NameAttribute('Diseases of Genitourinary System')]
    #[ChildAttribute(CategoryIVType::class)]
    #[RangeAttribute('N00', 'N99')]
    #[PublicAttribute(true)]
    case CATEGORY_XIV = 14;

    #[ColorAttribute('#018ECC')]
    #[NameAttribute('Pregnancy, Childbirth, and the Puerperium')]
    #[ChildAttribute(CategoryXVType::class)]
    #[RangeAttribute('O00', 'O9A')]
    #[PublicAttribute(true)]
    case CATEGORY_XV = 15;

    #[ColorAttribute('#004665')]
    #[NameAttribute('Certain Conditions Originating in the Perinatal Period')]
    #[ChildAttribute(CategoryXVIType::class)]
    #[RangeAttribute('P00', 'P96')]
    #[PublicAttribute(true)]
    case CATEGORY_XVI = 16;

    #[ColorAttribute('#C6A5CB')]
    #[NameAttribute('Congenital malformations, deformations, and chromosomal abnormalities')]
    #[ChildAttribute(CategoryXVIIType::class)]
    #[RangeAttribute('Q00', 'Q99')]
    #[PublicAttribute(true)]
    case CATEGORY_XVII = 17;

    #[ColorAttribute('#D471E2')]
    #[NameAttribute('Symptoms, signs, and abnormal clinical and laboratory findings, not elsewhere classified')]
    #[ChildAttribute(CategoryXVIIIType::class)]
    #[RangeAttribute('R00', 'R99')]
    #[PublicAttribute(true)]
    case CATEGORY_XVIII = 18;

    #[ColorAttribute('#6F007F')]
    #[NameAttribute('Injury, poisoning, and certain other consequences of external causes')]
    #[ChildAttribute(CategoryXIXType::class)]
    #[RangeAttribute('S00', 'T88')]
    #[PublicAttribute(true)]
    case CATEGORY_XIX = 19;

    #[ColorAttribute('#FFD2F6')]
    #[NameAttribute('Codes for Special Purposes')]
    #[ChildAttribute(CategoryXXType::class)]
    #[RangeAttribute('U00', 'U85')]
    #[PublicAttribute(true)]
    case CATEGORY_XX = 20;

    #[ColorAttribute('#FB90E5')]
    #[NameAttribute('External Causes of Morbidity')]
    #[ChildAttribute(CategoryXXIType::class)]
    #[RangeAttribute('V00', 'Y99')]
    #[PublicAttribute(true)]
    case CATEGORY_XXI = 21;

    #[ColorAttribute('#F60FC7')]
    #[NameAttribute('Factors influencing health status and contact with health services')]
    #[ChildAttribute(CategoryXXIIType::class)]
    #[RangeAttribute('Z00', 'Z99')]
    #[PublicAttribute(true)]
    case CATEGORY_XXII = 22;
}
