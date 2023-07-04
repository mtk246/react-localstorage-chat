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

enum CategoryXXIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Persons encountering health services for examinations')]
    #[RangeAttribute('Z00-Z13')]
    #[PublicAttribute(true)]
    case ENCOUNTERING_HEALTH_SERVICES_FOR_EXAMINATIONS = 1;

    #[NameAttribute('Genetic carrier and genetic susceptibility to disease')]
    #[RangeAttribute('Z14-Z15')]
    #[PublicAttribute(true)]
    case GENETIC_CARRIER_AND_SUSCEPTIBILITY = 2;

    #[NameAttribute('Resistance to antimicrobial drugs')]
    #[RangeAttribute('Z16-Z16')]
    #[PublicAttribute(true)]
    case RESISTANCE_TO_ANTIMICROBIAL_DRUGS = 3;

    #[NameAttribute('Estrogen receptor status')]
    #[RangeAttribute('Z17-Z17')]
    #[PublicAttribute(true)]
    case ESTROGEN_RECEPTOR_STATUS = 4;

    #[NameAttribute('Retained foreign body fragments')]
    #[RangeAttribute('Z18-Z18')]
    #[PublicAttribute(true)]
    case RETAINED_FOREIGN_BODY_FRAGMENTS = 5;

    #[NameAttribute('Hormone sensitivity malignancy status')]
    #[RangeAttribute('Z19-Z19')]
    #[PublicAttribute(true)]
    case HORMONE_SENSITIVITY_MALIGNANCY_STATUS = 6;

    #[NameAttribute('Persons with potential health hazards related to communicable diseases')]
    #[RangeAttribute('Z20-Z29')]
    #[PublicAttribute(true)]
    case POTENTIAL_HEALTH_HAZARDS_COMMUNICABLE_DISEASES = 7;

    #[NameAttribute('Persons encountering health services in circumstances related to reproduction')]
    #[RangeAttribute('Z30-Z39')]
    #[PublicAttribute(true)]
    case ENCOUNTERING_HEALTH_SERVICES_REPRODUCTION = 8;

    #[NameAttribute('Encounters for other specific health care')]
    #[RangeAttribute('Z40-Z53')]
    #[PublicAttribute(true)]
    case ENCOUNTERS_OTHER_SPECIFIC_HEALTHCARE = 9;

    #[NameAttribute('Persons with potential health hazards related to socioeconomic and psychosocial circumstances')]
    #[RangeAttribute('Z55-Z65')]
    #[PublicAttribute(true)]
    case POTENTIAL_HEALTH_HAZARDS_SOCIOECONOMIC = 10;

    #[NameAttribute('Do not resuscitate status')]
    #[RangeAttribute('Z66-Z66')]
    #[PublicAttribute(true)]
    case DO_NOT_RESUSCITATE_STATUS = 11;

    #[NameAttribute('Blood type')]
    #[RangeAttribute('Z67-Z67')]
    #[PublicAttribute(true)]
    case BLOOD_TYPE = 12;

    #[NameAttribute('Body mass index (BMI)')]
    #[RangeAttribute('Z68-Z68')]
    #[PublicAttribute(true)]
    case BODY_MASS_INDEX = 13;

    #[NameAttribute('Persons encountering health services in other circumstances')]
    #[RangeAttribute('Z69-Z76')]
    #[PublicAttribute(true)]
    case ENCOUNTERING_HEALTH_SERVICES_OTHER_CIRCUMSTANCES = 14;

    #[NameAttribute('Persons with potential health hazards related to family and personal history and certain conditions influencing health status')]
    #[RangeAttribute('Z77-Z99')]
    #[PublicAttribute(true)]
    case POTENTIAL_HEALTH_HAZARDS_FAMILY_PERSONAL_HISTORY = 15;
}
