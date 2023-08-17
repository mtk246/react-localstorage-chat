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

enum TemporaryCodeType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Miscellaneous Drugs and Tests')]
    #[RangeAttribute('Q0035', 'Q0144')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS_TESTS = 1;

    #[NameAttribute('Chemotherapy Anti-emetic Medications')]
    #[RangeAttribute('Q0161', 'Q0181')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_ANTI_EMETIC_MEDICATIONS = 2;

    #[NameAttribute('COVID-19 Infusion Therapy')]
    #[RangeAttribute('Q0220', 'Q0249')]
    #[PublicAttribute(true)]
    case COVID_19_INFUSION_THERAPY = 3;

    #[NameAttribute('Ventricular Assist Devices')]
    #[RangeAttribute('Q0477', 'Q0509')]
    #[PublicAttribute(true)]
    case VENTRICULAR_ASSIST_DEVICES = 4;

    #[NameAttribute('Pharmacy Supply and Dispensing Fees')]
    #[RangeAttribute('Q0510', 'Q0514')]
    #[PublicAttribute(true)]
    case PHARMACY_SUPPLY_DISPENSING_FEES = 5;

    #[NameAttribute('Miscellaneous Drug and New Technology Codes')]
    #[RangeAttribute('Q0515', 'Q2028')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUG_NEW_TECHNOLOGY_CODES = 6;

    #[NameAttribute('Influenza Virus Vaccines')]
    #[RangeAttribute('Q2034', 'Q2039')]
    #[PublicAttribute(true)]
    case INFLUENZA_VIRUS_VACCINES = 7;

    #[NameAttribute('Other Drugs and Service Fees')]
    #[RangeAttribute('Q2041', 'Q3031')]
    #[PublicAttribute(true)]
    case OTHER_DRUGS_SERVICE_FEES = 8;

    #[NameAttribute('Cast and Splint Supplies')]
    #[RangeAttribute('Q4001', 'Q4051')]
    #[PublicAttribute(true)]
    case CAST_SPLINT_SUPPLIES = 9;

    #[NameAttribute('Miscellaneous Drugs')]
    #[RangeAttribute('Q4074', 'Q4082')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS = 10;

    #[NameAttribute('Skin Substitutes and Biologicals')]
    #[RangeAttribute('Q4100', 'Q4271')]
    #[PublicAttribute(true)]
    case SKIN_SUBSTITUTES_BIOLOGICALS = 11;

    #[NameAttribute('Hospice and Home Health Care')]
    #[RangeAttribute('Q5001', 'Q5010')]
    #[PublicAttribute(true)]
    case HOSPICE_HOME_HEALTH_CARE = 12;

    #[NameAttribute('Additional Miscellaneous Drugs')]
    #[RangeAttribute('Q5101', 'Q5101')]
    #[PublicAttribute(true)]
    case ADDITIONAL_MISCELLANEOUS_DRUGS = 13;

    #[NameAttribute('Anti-Inflammatory Medication and Chemotherapy Medication')]
    #[RangeAttribute('Q5103', 'Q5111')]
    #[PublicAttribute(true)]
    case ANTI_INFLAMMATORY_CHEMOTHERAPY_MEDICATION = 14;

    #[NameAttribute('Cancer and Vision Associated Drugs')]
    #[RangeAttribute('Q5112', 'Q5130')]
    #[PublicAttribute(true)]
    case CANCER_VISION_ASSOCIATED_DRUGS = 15;

    #[NameAttribute('Assessment and Couseling-Department of Veterans Affairs Chaplain Services')]
    #[RangeAttribute('Q9001', 'Q9004')]
    #[PublicAttribute(true)]
    case ASSESSMENT_COUNSELING_DEPARTMENT_VETERANS_AFFAIRS_CHAPLAIN_SERVICES = 16;

    #[NameAttribute('Contrast Agents/Diagnostic Imaging')]
    #[RangeAttribute('Q9950', 'Q9983')]
    #[PublicAttribute(true)]
    case CONTRAST_AGENTS_DIAGNOSTIC_IMAGING = 17;

    #[NameAttribute('Other Drugs and Test')]
    #[RangeAttribute('Q9991', 'Q9992')]
    #[PublicAttribute(true)]
    case OTHER_DRUGS_TEST = 18;
}
