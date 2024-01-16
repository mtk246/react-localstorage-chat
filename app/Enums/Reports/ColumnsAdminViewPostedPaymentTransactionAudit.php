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

enum ColumnsAdminViewPostedPaymentTransactionAudit: string implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColumnsAttributes;

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
    #[AlignAttribute('left')]
    #[TextAttribute('Insurance')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case INSURANCE = 'insurance';

    #[TypeAttribute('string')]
    #[AlignAttribute('left')]
    #[TextAttribute('Facilities')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case FACILITIES = 'fascilities';

    #[TypeAttribute('string')]
    #[TextAttribute('Deposit date')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case DEPOSIT_DATE = 'deposit_date';

    #[TypeAttribute('string')]
    #[TextAttribute('Trans count')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case TRANS_COUNT = 'trans_count';

    #[TypeAttribute('string')]
    #[AlignAttribute('center')]
    #[TextAttribute('Amount')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case AMOUNT = 'amount';
}
