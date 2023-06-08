<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum TemporaryCodeType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Miscellaneous Drugs and Tests')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS_TESTS = 1;

    #[NameAttribute('Chemotherapy Anti-emetic Medications')]
    #[PublicAttribute(true)]
    case CHEMOTHERAPY_ANTI_EMETIC_MEDICATIONS = 2;

    #[NameAttribute('COVID-19 Infusion Therapy')]
    #[PublicAttribute(true)]
    case COVID_19_INFUSION_THERAPY = 3;

    #[NameAttribute('Ventricular Assist Devices')]
    #[PublicAttribute(true)]
    case VENTRICULAR_ASSIST_DEVICES = 4;

    #[NameAttribute('Pharmacy Supply and Dispensing Fees')]
    #[PublicAttribute(true)]
    case PHARMACY_SUPPLY_DISPENSING_FEES = 5;

    #[NameAttribute('Miscellaneous Drug and New Technology Codes')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUG_NEW_TECHNOLOGY_CODES = 6;

    #[NameAttribute('Influenza Virus Vaccines')]
    #[PublicAttribute(true)]
    case INFLUENZA_VIRUS_VACCINES = 7;

    #[NameAttribute('Other Drugs and Service Fees')]
    #[PublicAttribute(true)]
    case OTHER_DRUGS_SERVICE_FEES = 8;

    #[NameAttribute('Cast and Splint Supplies')]
    #[PublicAttribute(true)]
    case CAST_SPLINT_SUPPLIES = 9;

    #[NameAttribute('Miscellaneous Drugs')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DRUGS = 10;

    #[NameAttribute('Skin Substitutes and Biologicals')]
    #[PublicAttribute(true)]
    case SKIN_SUBSTITUTES_BIOLOGICALS = 11;

    #[NameAttribute('Hospice and Home Health Care')]
    #[PublicAttribute(true)]
    case HOSPICE_HOME_HEALTH_CARE = 12;

    #[NameAttribute('Additional Miscellaneous Drugs')]
    #[PublicAttribute(true)]
    case ADDITIONAL_MISCELLANEOUS_DRUGS = 13;

    #[NameAttribute('Anti-Inflammatory Medication and Chemotherapy Medication')]
    #[PublicAttribute(true)]
    case ANTI_INFLAMMATORY_CHEMOTHERAPY_MEDICATION = 14;

    #[NameAttribute('Cancer and Vision Associated Drugs')]
    #[PublicAttribute(true)]
    case CANCER_VISION_ASSOCIATED_DRUGS = 15;

    #[NameAttribute('Assessment and Couseling-Department of Veterans Affairs Chaplain Services')]
    #[PublicAttribute(true)]
    case ASSESSMENT_COUNSELING_DEPARTMENT_VETERANS_AFFAIRS_CHAPLAIN_SERVICES = 16;

    #[NameAttribute('Contrast Agents/Diagnostic Imaging')]
    #[PublicAttribute(true)]
    case CONTRAST_AGENTS_DIAGNOSTIC_IMAGING = 17;

    #[NameAttribute('Other Drugs and Test')]
    #[PublicAttribute(true)]
    case OTHER_DRUGS_TEST = 18;
}
