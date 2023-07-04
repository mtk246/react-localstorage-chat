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

enum CategoryVIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Inflammatory diseases of the central nervous system')]
    #[RangeAttribute('G00-G09')]
    #[PublicAttribute(true)]
    case INFLAMMATORY_DISEASES_OF_CNS = 1;

    #[NameAttribute('Systemic atrophies primarily affecting the central nervous system')]
    #[RangeAttribute('G10-G14')]
    #[PublicAttribute(true)]
    case SYSTEMIC_ATROPHIES_CNS = 2;

    #[NameAttribute('Extrapyramidal and movement disorders')]
    #[RangeAttribute('G20-G26')]
    #[PublicAttribute(true)]
    case EXTRAPYRAMIDAL_MOVEMENT_DISORDERS = 3;

    #[NameAttribute('Other degenerative diseases of the nervous system')]
    #[RangeAttribute('G30-G32')]
    #[PublicAttribute(true)]
    case OTHER_DEGENERATIVE_DISEASES = 4;

    #[NameAttribute('Demyelinating diseases of the central nervous system')]
    #[RangeAttribute('G35-G37')]
    #[PublicAttribute(true)]
    case DEMYELINATING_DISEASES_CNS = 5;

    #[NameAttribute('Episodic and paroxysmal disorders')]
    #[RangeAttribute('G40-G47')]
    #[PublicAttribute(true)]
    case EPISODIC_PAROXYSMAL_DISORDERS = 6;

    #[NameAttribute('Nerve, nerve root and plexus disorders')]
    #[RangeAttribute('G50-G59')]
    #[PublicAttribute(true)]
    case NERVE_DISORDERS = 7;

    #[NameAttribute('Polyneuropathies and other disorders of the peripheral nervous system')]
    #[RangeAttribute('G60-G65')]
    #[PublicAttribute(true)]
    case POLYNEUROPATHIES = 8;

    #[NameAttribute('Diseases of myoneural junction and muscle')]
    #[RangeAttribute('G70-G73')]
    #[PublicAttribute(true)]
    case DISEASES_MYONEURAL_JUNCTION = 9;

    #[NameAttribute('Cerebral palsy and other paralytic syndromes')]
    #[RangeAttribute('G80-G83')]
    #[PublicAttribute(true)]
    case CEREBRAL_PALSY = 10;

    #[NameAttribute('Other disorders of the nervous system')]
    #[RangeAttribute('G89-G99')]
    #[PublicAttribute(true)]
    case OTHER_NERVOUS_DISORDERS = 11;
}
