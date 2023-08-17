<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class FacilityTaxonomy extends Pivot implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
