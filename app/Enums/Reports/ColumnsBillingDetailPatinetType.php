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

enum ColumnsBillingDetailPatinetType: string implements TypeInterface
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
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';

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
    #[TextAttribute('ssn')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case SSN = 'ssn';

    #[TypeAttribute('string')]
    #[TextAttribute('Driver license')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case DRIVER_LICENSE = 'driver_license';

    #[TypeAttribute('string')]
    #[TextAttribute('Language')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case LANGUAGE = 'language';

    #[TypeAttribute('string')]
    #[TextAttribute('Date of Death')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case DATE_OF_DEATH = 'date_of_death';

    #[TypeAttribute('string')]
    #[TextAttribute('Marital Status')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case MATERIAL_STATUS = 'marital_status';

    #[TypeAttribute('string')]
    #[TextAttribute('Phone')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case PHONE = 'phone';

    #[TypeAttribute('string')]
    #[TextAttribute('Cell phone')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case CELL_PHONE = 'cell_phone';

    #[TypeAttribute('string')]
    #[TextAttribute('Fax')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case FAX = 'fax';

    #[TypeAttribute('string')]
    #[TextAttribute('Email')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case EMAIL = 'email';

    #[TypeAttribute('string')]
    #[TextAttribute('Type address')]
    #[AlignAttribute('left')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case TYPE_ADDRESS = 'type_address';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Apt / Other')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case APT_SUITE = 'apt_suite';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Zip')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case ZIP = 'zip';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('City')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case CITY = 'city';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('State')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case STATE = 'state';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('country')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case COUNTRY = 'country';
}
