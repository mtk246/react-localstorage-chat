<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class FacilityFacilityType extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public function facilityType()
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
