<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\ICD10\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryXVType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Pregnancy with abortive outcome')]
    #[RangeAttribute('O00', 'O08')]
    #[PublicAttribute(true)]
    case EmbarazoConResultadoAbortivo = 1;

    #[NameAttribute('Supervision of high-risk pregnancy')]
    #[RangeAttribute('O09', 'O09')]
    #[PublicAttribute(true)]
    case SupervisionEmbarazoAltoRiesgo = 2;

    #[NameAttribute('Edema, proteinuria and hypertensive disorders in pregnancy, childbirth and the puerperium')]
    #[RangeAttribute('O10', 'O16')]
    #[PublicAttribute(true)]
    case EdemaProteinuriaTrastornosHipertensivosEmbarazo = 3;

    #[NameAttribute('Other maternal disorders predominantly related to pregnancy')]
    #[RangeAttribute('O20', 'O29')]
    #[PublicAttribute(true)]
    case OtrosTrastornosMaternosRelacionadosEmbarazo = 4;

    #[NameAttribute('Maternal care related to the fetus and amniotic cavity and possible delivery problems')]
    #[RangeAttribute('O30', 'O48')]
    #[PublicAttribute(true)]
    case CuidadoMaternoRelacionadoFetoCavidadAmniotica = 5;

    #[NameAttribute('Complications of labor and delivery')]
    #[RangeAttribute('O60', 'O77')]
    #[PublicAttribute(true)]
    case ComplicacionesParto = 6;

    #[NameAttribute('Encounter for delivery')]
    #[RangeAttribute('O80', 'O82')]
    #[PublicAttribute(true)]
    case EncuentroParto = 7;

    #[NameAttribute('Complications predominantly related to the puerperium')]
    #[RangeAttribute('O85', 'O92')]
    #[PublicAttribute(true)]
    case ComplicacionesPuerperio = 8;

    #[NameAttribute('Other obstetric conditions, not elsewhere classified')]
    #[RangeAttribute('O94', 'O9A')]
    #[PublicAttribute(true)]
    case OtrasCondicionesObstetricas = 9;
}
