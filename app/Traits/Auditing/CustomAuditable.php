<?php

declare(strict_types=1);

namespace App\Traits\Auditing;

use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\AttributeRedactor;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Exceptions\AuditableTransitionException;

trait CustomAuditable
{
    use AuditableTrait;

    public function transitionTo(Audit $audit, bool $old = false): Auditable
    {
        // The Audit must be for an Auditable model of this type
        if ($this->getMorphClass() !== $audit->auditable_type) {
            throw new AuditableTransitionException(sprintf('Expected Auditable type %s, got %s instead', $this->getMorphClass(), $audit->auditable_type));
        }

        // The Audit must be for this specific Auditable model
        if ((string) $this->getKey() !== $audit->auditable_id) {
            throw new AuditableTransitionException(sprintf('Expected Auditable id (%s)%s, got (%s)%s instead', gettype($this->getKey()), $this->getKey(), gettype($audit->auditable_id), $audit->auditable_id));
        }

        // Redacted data should not be used when transitioning states
        foreach ($this->getAttributeModifiers() as $attribute => $modifier) {
            if (is_subclass_of($modifier, AttributeRedactor::class)) {
                throw new AuditableTransitionException('Cannot transition states when an AttributeRedactor is set');
            }
        }

        // The attribute compatibility between the Audit and the Auditable model must be met
        $modified = $audit->getModified();

        if ($incompatibilities = array_diff_key($modified, $this->getAttributes())) {
            throw new AuditableTransitionException(sprintf('Incompatibility between [%s:%s] and [%s:%s]', $this->getMorphClass(), $this->getKey(), get_class($audit), $audit->getKey()), array_keys($incompatibilities));
        }

        $key = $old ? 'old' : 'new';

        foreach ($modified as $attribute => $value) {
            if (array_key_exists($key, $value)) {
                $this->setAttribute($attribute, $value[$key]);
            }
        }

        return $this;
    }
}
