<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasColumnsAttributes;

enum TypeReportAll: string implements TypeInterface
{
    use HasColumnsAttributes;

    #[TextAttribute('view_detailed_patient')]
    #[NameAttribute('detailed_patient')]
    #[PublicAttribute(true)]
    case PGFOODVKOC = 'PGFOODVKOC';

    #[TextAttribute('view_general_patient')]
    #[NameAttribute('general_patient')]
    #[PublicAttribute(true)]
    case JBEPEUZRBK = 'JBEPEUZRBK';

    #[TextAttribute('view_general_facility')]
    #[NameAttribute('general_facility')]
    #[PublicAttribute(true)]
    case QVHZFWCVGJ = 'QVHZFWCVGJ';

    #[TextAttribute('view_general_healthcare_professional')]
    #[NameAttribute('general_healthcare_professional')]
    #[PublicAttribute(true)]
    case QNSJADXODC = 'QNSJADXODC';

    #[TextAttribute('view_payer_mix')]
    #[NameAttribute('payer_mix')]
    #[PublicAttribute(true)]
    case HHSUUILJFV = 'HHSUUILJFV';

    #[TextAttribute('view_professional_productivity')]
    #[NameAttribute('professional_productivity')]
    #[PublicAttribute(true)]
    case TPEMOBKSKL = 'TPEMOBKSKL';

    #[TextAttribute('view_bad_debt_cost')]
    #[NameAttribute('bad_debt_cost')]
    #[PublicAttribute(true)]
    case WSTRTDBWPZ = 'WSTRTDBWPZ';

    #[TextAttribute('view_change_by_module')]
    #[NameAttribute('change_by_module')]
    #[PublicAttribute(true)]
    case ZHJZLMVKWP = 'ZHJZLMVKWP';

    #[TextAttribute('view_daily_insurance_responsibility_aging')]
    #[NameAttribute('daily_insurance_responsibility_aging')]
    #[PublicAttribute(true)]
    case GTGFOJQBHQ = 'GTGFOJQBHQ';

    #[TextAttribute('view_posted_payment_transaction_audit')]
    #[NameAttribute('posted_payment_transaction_audit')]
    #[PublicAttribute(true)]
    case PDZEFFROWW = 'PDZEFFROWW';
}
