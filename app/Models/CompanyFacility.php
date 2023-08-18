<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class CompanyFacility extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
