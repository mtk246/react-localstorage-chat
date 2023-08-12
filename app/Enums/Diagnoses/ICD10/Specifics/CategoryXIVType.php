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

enum CategoryXIVType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Glomerular diseases')]
    #[RangeAttribute('N00', 'N08')]
    #[PublicAttribute(true)]
    case GlomerularDiseases = 1;

    #[NameAttribute('Renal tubulo-interstitial diseases')]
    #[RangeAttribute('N10', 'N16')]
    #[PublicAttribute(true)]
    case RenalTubuloInterstitialDiseases = 2;

    #[NameAttribute('Acute kidney failure and chronic kidney disease')]
    #[RangeAttribute('N17', 'N19')]
    #[PublicAttribute(true)]
    case AcuteKidneyFailureAndChronicKidneyDisease = 3;

    #[NameAttribute('Urolithiasis')]
    #[RangeAttribute('N20', 'N23')]
    #[PublicAttribute(true)]
    case Urolithiasis = 4;

    #[NameAttribute('Other disorders of kidney and ureter')]
    #[RangeAttribute('N25', 'N29')]
    #[PublicAttribute(true)]
    case OtherDisordersOfKidneyAndUreter = 5;

    #[NameAttribute('Other diseases of the urinary system')]
    #[RangeAttribute('N30', 'N39')]
    #[PublicAttribute(true)]
    case OtherDiseasesOfTheUrinarySystem = 6;

    #[NameAttribute('Diseases of male genital organs')]
    #[RangeAttribute('N40', 'N53')]
    #[PublicAttribute(true)]
    case DiseasesOfMaleGenitalOrgans = 7;

    #[NameAttribute('Disorders of breast')]
    #[RangeAttribute('N60', 'N65')]
    #[PublicAttribute(true)]
    case DisordersOfBreast = 8;

    #[NameAttribute('Inflammatory diseases of female pelvic organs')]
    #[RangeAttribute('N70', 'N77')]
    #[PublicAttribute(true)]
    case InflammatoryDiseasesOfFemalePelvicOrgans = 9;

    #[NameAttribute('Noninflammatory disorders of female genital tract')]
    #[RangeAttribute('N80', 'N98')]
    #[PublicAttribute(true)]
    case NoninflammatoryDisordersOfFemaleGenitalTract = 10;

    #[NameAttribute('Intraoperative and postprocedural complications and disorders of genitourinary system, not elsewhere classified')]
    #[RangeAttribute('N99', 'N99')]
    #[PublicAttribute(true)]
    case IntraoperativeAndPostproceduralComplicationsAndDisordersOfGenitourinarySystem = 11;
}
