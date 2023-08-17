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

enum CategoryVType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Mental disorders due to known physiological conditions')]
    #[RangeAttribute('F01', 'F09')]
    #[PublicAttribute(true)]
    case MENTAL_DISORDERS_DUE_TO_KNOWN_PHYSIOLOGICAL_CONDITIONS = 1;

    #[NameAttribute('Mental and behavioral disorders due to psychoactive substance use')]
    #[RangeAttribute('F10', 'F19')]
    #[PublicAttribute(true)]
    case MENTAL_AND_BEHAVIORAL_DISORDERS_DUE_TO_PSYCHOACTIVE_SUBSTANCE_USE = 2;

    #[NameAttribute('Schizophrenia, schizotypal, delusional, and other non-mood psychotic disorders')]
    #[RangeAttribute('F20', 'F29')]
    #[PublicAttribute(true)]
    case SCHIZOPHRENIA_AND_OTHER_NON_MOOD_PSYCHOTIC_DISORDERS = 3;

    #[NameAttribute('Mood [affective] disorders')]
    #[RangeAttribute('F30', 'F39')]
    #[PublicAttribute(true)]
    case MOOD_DISORDERS = 4;

    #[NameAttribute('Anxiety, dissociative, stress-related, somatoform and other nonpsychotic mental disorders')]
    #[RangeAttribute('F40', 'F48')]
    #[PublicAttribute(true)]
    case ANXIETY_AND_OTHER_NONPSYCHOTIC_MENTAL_DISORDERS = 5;

    #[NameAttribute('Behavioral syndromes associated with physiological disturbances and physical factors')]
    #[RangeAttribute('F50', 'F59')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_SYNDROMES_ASSOCIATED_WITH_PHYSIOLOGICAL_DISTURBANCES = 6;

    #[NameAttribute('Disorders of adult personality and behavior')]
    #[RangeAttribute('F60', 'F69')]
    #[PublicAttribute(true)]
    case DISORDERS_OF_ADULT_PERSONALITY_AND_BEHAVIOR = 7;

    #[NameAttribute('Intellectual disabilities')]
    #[RangeAttribute('F70', 'F79')]
    #[PublicAttribute(true)]
    case INTELLECTUAL_DISABILITIES = 8;

    #[NameAttribute('Pervasive and specific developmental disorders')]
    #[RangeAttribute('F80', 'F89')]
    #[PublicAttribute(true)]
    case PERVASIVE_AND_SPECIFIC_DEVELOPMENTAL_DISORDERS = 9;

    #[NameAttribute('Behavioral and emotional disorders with onset usually occurring in childhood and adolescence')]
    #[RangeAttribute('F90', 'F98')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_AND_EMOTIONAL_DISORDERS_WITH_ONSET_IN_CHILDHOOD_AND_ADOLESCENCE = 10;

    #[NameAttribute('Unspecified mental disorder')]
    #[RangeAttribute('F99', 'F99')]
    #[PublicAttribute(true)]
    case UNSPECIFIED_MENTAL_DISORDER = 11;
}
