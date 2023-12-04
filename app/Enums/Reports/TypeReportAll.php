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
}
