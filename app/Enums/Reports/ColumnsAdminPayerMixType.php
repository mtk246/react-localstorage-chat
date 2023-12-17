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

enum ColumnsAdminPayerMixType: string implements TypeInterface
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
    #[TextAttribute('Insurance')]
    #[AlignAttribute('left')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case INSURANCE = 'insurance';

    #[TypeAttribute('string')]
    #[TextAttribute('Claims processed')]
    #[AlignAttribute('center')]
    #[WidthAttribute('370px')]
    #[PublicAttribute(true)]
    case CLAIMS_PROCESSED = 'claims_processed';

    #[TypeAttribute('string')]
    #[AlignAttribute('center')]
    #[TextAttribute('% Of Total Charges')]
    #[WidthAttribute('110px')]
    #[PublicAttribute(true)]
    case PORCENTAJE = 'porcentaje';

    #[TypeAttribute('string')]
    #[TextAttribute('Charges')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case CHARGES = 'charges';

    #[TypeAttribute('string')]
    #[TextAttribute('Total payments')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case TOTAL_PAYMENTS = 'total_payments';

    #[TypeAttribute('string')]
    #[TextAttribute('Payments amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('270px')]
    #[PublicAttribute(true)]
    case PAYMENTS_AMOUNT = 'payments_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Total write offs')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TOTAL_WRITE_OFFS = 'total_write_offs';

    #[TypeAttribute('string')]
    #[TextAttribute('Write offs amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case WRITEOFFS_AMOUNT = 'writeoffs_amount';

    #[TypeAttribute('string')]
    #[TextAttribute('Total denied')]
    #[AlignAttribute('center')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case TOTAL_DENIED = 'total_denied';

    #[TypeAttribute('string')]
    #[TextAttribute('Plan')]
    #[AlignAttribute('left')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case PLAN = 'plan';

    #[TypeAttribute('string')]
    #[TextAttribute('Plan type')]
    #[AlignAttribute('left')]
    #[WidthAttribute('170px')]
    #[PublicAttribute(true)]
    case PLAN_TYPE = 'plan_type';

    #[TypeAttribute('string')]
    #[TextAttribute('% of total Payments')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case TOTAL_PAYMENTS_PLAN = 'total_payments_plan';

    #[TypeAttribute('string')]
    #[TextAttribute('Payments Amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case PAYMENTS_AMOUNT_PLAN = 'payments_amount_plan';

    #[TypeAttribute('string')]
    #[TextAttribute('% of total write offs')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case TOTAL_WRITE_OFFS_PLAN = 'total_write_offs_plan';
    
    #[TypeAttribute('string')]
    #[TextAttribute('Writeoffs Amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case WRITEOFFS_AMOUNT_PLAN = 'writeoffs_amount_plan';

    #[TypeAttribute('string')]
    #[TextAttribute('% of total denied')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case TOTAL_DENIED_PLAN = 'total_denied_plan';

    #[TypeAttribute('string')]
    #[TextAttribute('Denied Amount')]
    #[AlignAttribute('center')]
    #[WidthAttribute('100px')]
    #[PublicAttribute(true)]
    case DENIED_AMOUN_PLAN = 'denied_amoun_plant';
}
