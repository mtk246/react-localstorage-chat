<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\AlignAttribute;
use App\Enums\Attributes\ValueAttribute;
use App\Enums\Attributes\WidthAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColumnsAttributes;

enum ColumnsBillingGeneralPatinetType: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

    #[NameAttribute('id')]
    #[ValueAttribute('id')]
    #[TypeAttribute('string')]
    #[TextAttribute('Id')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case ID = 'id';

    #[NameAttribute('companies')]
    #[ValueAttribute('companies')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case COMPANIES = 'companies';

    #[NameAttribute('medical_no')]
    #[ValueAttribute('medical_no')]
    #[TypeAttribute('string')]
    #[TextAttribute('Medical no')]
    #[AlignAttribute('center')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case MEDICAL_NO = 'medical_no';

    #[NameAttribute('system_code')]
    #[ValueAttribute('system_code')]
    #[TypeAttribute('string')]
    #[TextAttribute('System Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SYSTEM_CODE = 'system_code';

    #[NameAttribute('patient_name')]
    #[ValueAttribute('patient_name')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Patient Name')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PATIENT_NAME = 'patient_name';

    #[NameAttribute('date_of_birth')]
    #[ValueAttribute('date_of_birth')]
    #[TypeAttribute('string')]
    #[TextAttribute('Date of birth')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case DATE_OF_BIRTH = 'date_of_birth';

    #[NameAttribute('sex')]
    #[ValueAttribute('sex')]
    #[TypeAttribute('string')]
    #[TextAttribute('Sex')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case SEX = 'sex';

    #[NameAttribute('claims_processed')]
    #[ValueAttribute('claims_processed')]
    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';

    static public function getValues(): array|null
    {
        $cases = [];
        foreach (self::cases() as $case) {
            array_push($cases, $case->value);
        }

        return $cases;
    }
}
