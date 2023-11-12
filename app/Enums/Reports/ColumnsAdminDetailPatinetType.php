<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\AlignAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Attributes\ValueAttribute;
use App\Enums\Attributes\WidthAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColumnsAttributes;

enum ColumnsAdminDetailPatinetType: string implements TypeInterface
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

    #[NameAttribute('billing_companies')]
    #[ValueAttribute('billing_companies')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Billing companies')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case BILLING_COMPANIES = 'billing_companies';

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

    #[NameAttribute('claims_processed')]
    #[ValueAttribute('claims_processed')]
    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';

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

    #[NameAttribute('ssn')]
    #[ValueAttribute('ssn')]
    #[TypeAttribute('string')]
    #[TextAttribute('ssn')]
    #[AlignAttribute('center')]
    #[WidthAttribute('70px')]
    #[PublicAttribute(true)]
    case SSN = 'ssn';

    #[NameAttribute('driver_license')]
    #[ValueAttribute('driver_license')]
    #[TypeAttribute('string')]
    #[TextAttribute('Driver license')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case DRIVER_LICENSE = 'driver_license';

    #[NameAttribute('language')]
    #[ValueAttribute('language')]
    #[TypeAttribute('string')]
    #[TextAttribute('Language')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case LANGUAGE = 'language';

    #[NameAttribute('date_of_death')]
    #[ValueAttribute('date_of_death')]
    #[TypeAttribute('string')]
    #[TextAttribute('Date of Death')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case DATE_OF_DEATH = 'date_of_death';

    #[NameAttribute('marital_status')]
    #[ValueAttribute('marital_status')]
    #[TypeAttribute('string')]
    #[TextAttribute('Marital Status')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case MATERIAL_STATUS = 'marital_status';

    #[NameAttribute('phone')]
    #[ValueAttribute('phone')]
    #[TypeAttribute('string')]
    #[TextAttribute('Phone')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case PHONE = 'phone';

    #[NameAttribute('cell_phone')]
    #[ValueAttribute('cell_phone')]
    #[TypeAttribute('string')]
    #[TextAttribute('Cell phone')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case CELL_PHONE = 'cell_phone';

    #[NameAttribute('fax')]
    #[ValueAttribute('fax')]
    #[TypeAttribute('string')]
    #[TextAttribute('Fax')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case FAX = 'fax';

    #[NameAttribute('email')]
    #[ValueAttribute('email')]
    #[TypeAttribute('string')]
    #[TextAttribute('Email')]
    #[AlignAttribute('center')]
    #[WidthAttribute('130px')]
    #[PublicAttribute(true)]
    case EMAIL = 'email';

    #[NameAttribute('type_address')]
    #[ValueAttribute('type_address')]
    #[TypeAttribute('string')]
    #[TextAttribute('Type address')]
    #[AlignAttribute('left')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case TYPE_ADDRESS = 'type_address';

    #[NameAttribute('apt_suite')]
    #[ValueAttribute('apt_suite')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Apt / Other')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case APT_SUITE = 'apt_suite';

    #[NameAttribute('zip')]
    #[ValueAttribute('zip')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Zip')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case ZIP = 'zip';

    #[NameAttribute('city')]
    #[ValueAttribute('city')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('City')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case CITY = 'city';

    #[NameAttribute('state')]
    #[ValueAttribute('state')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('State')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case STATE = 'state';

    #[NameAttribute('country')]
    #[ValueAttribute('country')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('country')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case COUNTRY = 'country';
}
