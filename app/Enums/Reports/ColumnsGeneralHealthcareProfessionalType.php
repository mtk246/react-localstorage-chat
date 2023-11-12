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

enum ColumnsGeneralHealthcareProfessionalType: string implements TypeInterface
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

    #[NameAttribute('system_code')]
    #[ValueAttribute('system_code')]
    #[TypeAttribute('string')]
    #[TextAttribute('System Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SYSTEM_CODE = 'system_code';

    #[NameAttribute('healthcare_professional')]
    #[ValueAttribute('healthcare_professional')]
    #[TypeAttribute('string')]
    #[TextAttribute('Healthcare Professional')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case HEALTHCARE_PROFESSIONAL = 'healthcare_professional';

    #[NameAttribute('npi')]
    #[ValueAttribute('npi')]
    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('NPI')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case NPI = 'npi';

    #[NameAttribute('primary_taxonomy')]
    #[ValueAttribute('primary_taxonomy')]
    #[TypeAttribute('string')]
    #[TextAttribute('Primary taxonomy')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PRIMARY_TAXONOMY = 'primary_taxonomy';

    #[NameAttribute('health_professional_type')]
    #[ValueAttribute('health_professional_type')]
    #[TypeAttribute('string')]
    #[TextAttribute('Type')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case HEALTH_PROFESSIONAL_TYPE = 'health_professional_type';

    #[NameAttribute('health_professional_role')]
    #[ValueAttribute('health_professional_role')]
    #[TypeAttribute('string')]
    #[TextAttribute('Role')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case HEALTH_PROFESSIONAL_ROLE = 'health_professional_role';

    #[NameAttribute('claims_processed')]
    #[ValueAttribute('claims_processed')]
    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';
}
