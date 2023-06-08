<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum TemporaryCodeNoMedicareType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Non-Medicare Drug Codes')]
    #[RangeAttribute('S0012', 'S0197')]
    #[PublicAttribute(true)]
    case NON_MEDICARE_DRUG_CODES = 1;

    #[NameAttribute('Miscellaneous Provider Services')]
    #[RangeAttribute('S0199', 'S0400')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PROVIDER_SERVICES = 2;

    #[NameAttribute('Vision Supplies')]
    #[RangeAttribute('S0500', 'S0596')]
    #[PublicAttribute(true)]
    case VISION_SUPPLIES = 3;

    #[NameAttribute('Screenings and Examinations')]
    #[RangeAttribute('S0601', 'S0622')]
    #[PublicAttribute(true)]
    case SCREENINGS_AND_EXAMINATIONS = 4;

    #[NameAttribute('Miscellaneous Provider Services and Supplies')]
    #[RangeAttribute('S0630', 'S3722')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_PROVIDER_SERVICES_AND_SUPPLIES = 5;

    #[NameAttribute('Genetic Testing')]
    #[RangeAttribute('S3800', 'S3870')]
    #[PublicAttribute(true)]
    case GENETIC_TESTING = 6;

    #[NameAttribute('Miscellaneous Tests')]
    #[RangeAttribute('S3900', 'S3904')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_TESTS = 7;

    #[NameAttribute('ASSORTED OBSTETRICAL AND FERTILITY SERVICES')]
    #[RangeAttribute('S4005', 'S4989')]
    #[PublicAttribute(true)]
    case ASSORTED_OBSTETRICAL_AND_FERTILITY_SERVICES = 8;

    #[NameAttribute('Miscellaneous Medications and Therapeutic Substances')]
    #[RangeAttribute('S4990', 'S5014')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_MEDICATIONS_AND_THERAPEUTIC_SUBSTANCES = 9;

    #[NameAttribute('Various Home Care Services')]
    #[RangeAttribute('S5035', 'S5199')]
    #[PublicAttribute(true)]
    case VARIOUS_HOME_CARE_SERVICES = 10;

    #[NameAttribute('Home Infusion Therapy')]
    #[RangeAttribute('S5497', 'S5523')]
    #[PublicAttribute(true)]
    case HOME_INFUSION_THERAPY = 11;

    #[NameAttribute('Insulin and Delivery Devices')]
    #[RangeAttribute('S5550', 'S5571')]
    #[PublicAttribute(true)]
    case INSULIN_AND_DELIVERY_DEVICES = 12;

    #[NameAttribute('Imaging Studies')]
    #[RangeAttribute('S8030', 'S8092')]
    #[PublicAttribute(true)]
    case IMAGING_STUDIES = 13;

    #[NameAttribute('Assisted Breathing Supplies')]
    #[RangeAttribute('S8096', 'S8210')]
    #[PublicAttribute(true)]
    case ASSISTED_BREATHING_SUPPLIES = 14;

    #[NameAttribute('Miscellaneous Supplies and Services')]
    #[RangeAttribute('S8265', 'S9152')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES_AND_SERVICES = 15;

    #[NameAttribute('Home Management of Pregnancy')]
    #[RangeAttribute('S9208', 'S9214')]
    #[PublicAttribute(true)]
    case HOME_MANAGEMENT_OF_PREGNANCY = 16;

    #[NameAttribute('Home Infusion Therapy')]
    #[RangeAttribute('S9325', 'S9379')]
    #[PublicAttribute(true)]
    case HOME_INFUSION_THERAPY_new = 17;

    #[NameAttribute('Miscellaneous Supplies and Services')]
    #[RangeAttribute('S9381', 'S9485')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES_AND_SERVICES_new = 18;

    #[NameAttribute('Home Therapy Services')]
    #[RangeAttribute('S9490', 'S9810')]
    #[PublicAttribute(true)]
    case HOME_THERAPY_SERVICES = 19;

    #[NameAttribute('Various Services, Fees, and Costs')]
    #[RangeAttribute('S9900', 'S9999')]
    #[PublicAttribute(true)]
    case VARIOUS_SERVICES_FEES_AND_COSTS = 20;
}
