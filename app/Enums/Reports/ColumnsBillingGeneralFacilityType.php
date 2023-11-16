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

enum ColumnsBillingGeneralFacilityType: string implements TypeInterface
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
    #[TextAttribute('Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CODE = 'code';

    #[TypeAttribute('string')]
    #[TextAttribute('Facility')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FACILITY = 'facility';

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
    #[TextAttribute('Place of serice')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PLACE_OF_SERVICE = 'place_of_serice';

    #[TypeAttribute('string')]
    #[TextAttribute('Type of facility')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TYPE_OF_FACILITY = 'type_of_facility';

    #[TypeAttribute('string')]
    #[TextAttribute('Bill classifications')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case BILL_CLASSIFICATIONS = 'bill_classifications';

    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';
}
