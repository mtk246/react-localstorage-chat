<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum TemporaryCodeNoMedicareType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Non-Medicare Drug Codes')]
    #[PublicAttribute(true)]
    case NON_MEDICARE_DRUG_CODES = 1;

    #[NameAttribute('Miscellaneous Provider Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PROVIDER_SERVICES = 2;

    #[NameAttribute('Vision Supplies')]
    #[PublicAttribute(true)]
    case VISION_SUPPLIES = 3;

    #[NameAttribute('Screenings and Examinations')]
    #[PublicAttribute(true)]
    case SCREENINGS_AND_EXAMINATIONS = 4;

    #[NameAttribute('Miscellaneous Provider Services and Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PROVIDER_SERVICES_AND_SUPPLIES = 5;

    #[NameAttribute('Genetic Testing')]
    #[PublicAttribute(true)]
    case GENETIC_TESTING = 6;

    #[NameAttribute('Miscellaneous Tests')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_TESTS = 7;

    #[NameAttribute('ASSORTED OBSTETRICAL AND FERTILITY SERVICES')]
    #[PublicAttribute(true)]
    case ASSORTED_OBSTETRICAL_AND_FERTILITY_SERVICES = 8;

    #[NameAttribute('Miscellaneous Medications and Therapeutic Substances')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_MEDICATIONS_AND_THERAPEUTIC_SUBSTANCES = 9;

    #[NameAttribute('Various Home Care Services')]
    #[PublicAttribute(true)]
    case VARIOUS_HOME_CARE_SERVICES = 10;

    #[NameAttribute('Home Infusion Therapy')]
    #[PublicAttribute(true)]
    case HOME_INFUSION_THERAPY = 11;

    #[NameAttribute('Insulin and Delivery Devices')]
    #[PublicAttribute(true)]
    case INSULIN_AND_DELIVERY_DEVICES = 12;

    #[NameAttribute('Imaging Studies')]
    #[PublicAttribute(true)]
    case IMAGING_STUDIES = 13;

    #[NameAttribute('Assisted Breathing Supplies')]
    #[PublicAttribute(true)]
    case ASSISTED_BREATHING_SUPPLIES = 14;

    #[NameAttribute('Miscellaneous Supplies and Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES_AND_SERVICES = 15;

    #[NameAttribute('Home Management of Pregnancy')]
    #[PublicAttribute(true)]
    case HOME_MANAGEMENT_OF_PREGNANCY = 16;

    #[NameAttribute('Home Infusion Therapy')]
    #[PublicAttribute(true)]
    case HOME_INFUSION_THERAPY_new = 17;

    #[NameAttribute('Miscellaneous Supplies and Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES_AND_SERVICES_new = 18;

    #[NameAttribute('Home Therapy Services')]
    #[PublicAttribute(true)]
    case HOME_THERAPY_SERVICES = 19;

    #[NameAttribute('Various Services, Fees, and Costs')]
    #[PublicAttribute(true)]
    case VARIOUS_SERVICES_FEES_AND_COSTS = 20;
}
