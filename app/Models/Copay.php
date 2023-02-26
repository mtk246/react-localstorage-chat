<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/** @todo compleate model structure */
class Copay extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "copay",
        "company_id",
        "insurance_plan_id",
        "billing_company_id",
    ];

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }
}
