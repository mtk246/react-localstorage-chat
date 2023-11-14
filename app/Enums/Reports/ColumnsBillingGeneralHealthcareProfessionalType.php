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

enum ColumnsBillingGeneralHealthcareProfessionalType: string implements TypeInterface
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
    #[TextAttribute('System Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case SYSTEM_CODE = 'system_code';

    #[TypeAttribute('string')]
    #[TextAttribute('Healthcare Professional')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case HEALTHCARE_PROFESSIONAL = 'healthcare_professional';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('NPI')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case NPI = 'npi';

    #[TypeAttribute('string')]
    #[TextAttribute('Primary taxonomy')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PRIMARY_TAXONOMY = 'primary_taxonomy';

    #[TypeAttribute('string')]
    #[TextAttribute('Type')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case HEALTH_PROFESSIONAL_TYPE = 'health_professional_type';

    #[TypeAttribute('string')]
    #[TextAttribute('Role')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case HEALTH_PROFESSIONAL_ROLE = 'health_professional_role';

    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';
}
