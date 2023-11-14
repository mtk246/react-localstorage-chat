<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\AlignAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Attributes\WidthAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColumnsAttributes;

enum ColumnsGeneralPatinetType: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[TypeAttribute('string')]
    #[TextAttribute('Id')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case ID = 'id';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Billing companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case BILLING_COMPANIES = 'billing_companies';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case COMPANIES = 'companies';

    #[TypeAttribute('string')]
    #[TextAttribute('Medical no')]
    #[AlignAttribute('center')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case MEDICAL_NO = 'medical_no';

    #[TypeAttribute('string')]
    #[TextAttribute('System Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SYSTEM_CODE = 'system_code';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Patient Name')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PATIENT_NAME = 'patient_name';

    #[TypeAttribute('string')]
    #[TextAttribute('Date of birth')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case DATE_OF_BIRTH = 'date_of_birth';

    #[TypeAttribute('string')]
    #[TextAttribute('Sex')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case SEX = 'sex';

    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';
}
