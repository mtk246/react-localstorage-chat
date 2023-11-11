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

enum ColumnsGeneralFacilityType: string implements TypeInterface
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

    #[NameAttribute('code')]
    #[ValueAttribute('code')]
    #[TypeAttribute('string')]
    #[TextAttribute('Code')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case CODE = 'code';

    #[NameAttribute('facility')]
    #[ValueAttribute('facility')]
    #[TypeAttribute('string')]
    #[TextAttribute('Facility')]
    #[AlignAttribute('left')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FACILITY = 'facility';

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

    #[NameAttribute('place_of_serice')]
    #[ValueAttribute('place_of_serice')]
    #[TypeAttribute('string')]
    #[TextAttribute('Place of serice')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PLACE_OF_SERVICE = 'place_of_serice';

    #[NameAttribute('type_of_facility')]
    #[ValueAttribute('type_of_facility')]
    #[TypeAttribute('string')]
    #[TextAttribute('Type of facility')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TYPE_OF_FACILITY = 'type_of_facility';

    #[NameAttribute('bill_classifications')]
    #[ValueAttribute('bill_classifications')]
    #[TypeAttribute('string')]
    #[TextAttribute('Bill classifications')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case BILL_CLASSIFICATIONS = 'bill_classifications';

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
